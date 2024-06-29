<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $transactions = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->select('m.*', 'u.*', 't.*')
            ->where('u.id', '=', $userId)
            ->get();

        // dd($transactions);
        return view('frontend.receipt', compact('transactions'));
    }

    public function detail($id)
    {
        $transaction = DB::table('transactions as t')
        ->join('memberships as m', 'm.transactions_id', '=', 't.id')
        ->join('users as u', 'u.id', '=', 'm.users_id')
        ->join('products_transactions as pt', 'pt.transactions_id', '=', 't.id')
        ->join('products as p', 'p.id', '=', 'pt.products_id')
        ->select('t.*', 'm.*', 'u.*', 'p.*', 'pt.*')
        ->where('t.id', '=', $id)
        ->get();

        // $transaction = $transaction->first();

        // dd($transaction);
        return view('frontend.detailreceipt', compact('transaction'));
    }

    public function checkout()
    {
        $cart = session('cart');

        // Cek apakah keranjang belanja kosong
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Keranjang belanja kosong. Tidak dapat melakukan checkout.');
        }

        $user = Auth::user();
        $t = new Transaction();

        $t->transaction_date = Carbon::now()->toDateTimeString();

        $grandTotal = array_sum(array_column($cart, 'sub_total')); // Total sebelum PPN
        // Hitung PPN
        $ppn = $grandTotal * 0.11; // PPN 11%
        $t->ppn = $ppn;
        $grandTotal += $ppn; // Total setelah ditambah PPN
        $t->total = $grandTotal;

        $t->save();

        $t_id = $t->id;

        // Insert into junction table product_transaction using eloquent
        $t->insertProducts($cart, $t_id);
        $t->membership($cart, $user, $t_id);

        // Calculate points based on cart contents
        // $points = $t->calculatePoints($cart);

        // Redeem points if applicable        
        // $grandTotal = $t->redeemPoints($points, $grandTotal);

        // Simpan total dan poin member ke dalam transaksi
        $t->save();

        // Clear cart
        session()->forget('cart');

        return redirect()->route('cart')->with('status', 'Checkout berhasil');
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
}
