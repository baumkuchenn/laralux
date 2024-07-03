<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    // Untuk menampilkan list transaksi sesuai customer
    public function index()
    {
        $userId = Auth::id();

        $transactions = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('m.*', 'u.*', 't.*')
            ->where('u.id', '=', $userId)
            ->whereNull('t.deleted_at')
            ->get();

        $allTransactions = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('m.*', 'u.*', 't.*')
            ->whereNull('t.deleted_at')
            ->get();

        // dd($allTransactions);
        return view('frontend.receipt', compact('transactions', 'allTransactions'));
    }

    public function detail($id)
    {
        $transaction = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->join('products_transactions as pt', 'pt.transactions_id', '=', 't.id')
            ->join('products as p', 'p.id', '=', 'pt.products_id')
            ->join('hotels as h', 'h.id', '=', 'p.hotel_id')
            ->select('t.*', 't.created_at as transaction_date', 'm.*', 'u.*', 'p.*', 'pt.*', 'h.nama as nama_hotel')
            ->where('t.id', '=', $id)
            ->get();

        // $transaction = $transaction->first();

        // dd($transaction);
        return view('frontend.detailreceipt', compact('transaction'));
    }

    public function checkout(Request $request)
    {
        $cart = session('cart');

        // Cek apakah keranjang belanja kosong
        if (empty($cart)) {
            return response()->json(['error' => 'Yahh, masih kosong nih. Yuk tambah produk dulu baru bisa checkout.'], 400);
        }

        $user = Auth::user();
        $t = new Transaction();

        $t->transaction_date = Carbon::now()->toDateTimeString();

        // Ambil data perhitungan dari sesi
        $calculatedTotal = session('calculated_total');

        if (!$calculatedTotal) {
            return response()->json(['error' => 'Data perhitungan tidak ditemukan. Silakan coba lagi.'], 400);
        }

        // PPN
        $ppn = $calculatedTotal['ppn']; // PPN 11%
        $t->ppn = $ppn;

        // Total setelah dikurangi penukaran poin
        $grandTotalAfterPoints = $calculatedTotal['grandTotalAfterPoints'];
        $t->total = $grandTotalAfterPoints;

        // Penukaran poin setara IDR
        $pointsToMoney = $calculatedTotal['pointsToMoney'];
        $t->penukaran_poin = $pointsToMoney;

        $t->save();

        // Ambil jumlah poin yang ingin ditukarkan dari sesion
        $redeemedPoints = $calculatedTotal['pointsToRedeem'];

        $t_id = $t->id;

        // Insert into junction table product_transaction using eloquent
        $t->insertProducts($cart, $t_id);
        $t->membership("transaksi", $cart, $user, $t_id, $redeemedPoints);

        // Simpan total dan poin member ke dalam transaksi
        $t->save();

        // Clear cart
        session()->forget('cart');

        return response()->json(['success' => 'Yeay! Checkout berhasil. Enjoyyy'], 200);
    }

    public function showAjax(Request $request)
    {
        $id = ($request->get('id'));
        $data = Transaction::find($id);
        $products = $data->products;
        return response()->json(array(
            'msg' => view('frontend.receipt', compact('data', 'products'))->render()
        ), 200);
    }

    public function destroy(string $id)
    {
        $user = Auth::user();
        $this->authorize('owner-permission', $user);
        try {
            Transaction::where('id', $id)->delete();
            $msg = 'Anda berhasil menghapus data';
        } catch (\PDOException $e) {
            $msg = 'Terjadi kesalahan pada saat menghapus data';
        }
        return redirect()->route('transaction.index')->with('status', $msg);
    }
}
