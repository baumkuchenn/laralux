<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    //
    public function addToCart($id)
    {
        $product = Product::find($id);
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            $cart[$id] = [
                'id' => $id,
                'name' => $product->nama,
                'quantity' => 1,
                'price' => $product->price,
                'sub_total' => $product->price // sub_total dihitung di sini
            ];
        } else {
            $cart[$id]['quantity']++;
            $cart[$id]['sub_total'] = $cart[$id]['quantity'] * $cart[$id]['price']; // Update sub_total jika kuantitas berubah
        }

        $cartItemCount = array_sum(array_column($cart, 'quantity'));
        session()->put('cart', $cart);
        session()->put('cartItemCount', $cartItemCount);

        return redirect()->back()->with("status", "Yeayy, produk berhasil ditambahkan ke Cart")->with('cartItemCount', $cartItemCount);
    }


    public function cart()
    {
        $userId = Auth::id();

        // Query untuk mengambil total poin dari membership
        $points = DB::table('transactions as t')
            ->join('memberships as m', 'm.transactions_id', '=', 't.id')
            ->join('users as u', 'u.id', '=', 'm.users_id')
            ->where('u.id', '=', $userId)
            ->where('m.points', '>', '0')
            ->sum('m.points');

        return view('frontend.cart', compact('points'));
    }

    public function addQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        $product = Product::find($cart[$id]['id']);
        if (isset($cart[$id])) {
            $jumlahAwal = $cart[$id]['quantity'];
            $jumlahPesan = $jumlahAwal + 1;
            if ($jumlahPesan < $product->available_room) {
                $cart[$id]['quantity']++;
            } else {
                return redirect()->back()->with('error', 'Jumlah pemesanan melebihi total kamar yang tersedia');
            }
        }
        session()->forget('cart');
        session()->put('cart', $cart);
    }

    public function reduceQuantity(Request $request)
    {
        $id = $request->id;
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 0) {
                $cart[$id]['quantity']--;
            }
        }
        session()->forget('cart');
        session()->put('cart', $cart);
    }

    public function deleteFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }
        session()->forget('cart');
        session()->put('cart', $cart);
        return redirect()->back()->with("status", "Produk berhasil dihapus dari Cart sii, cuma sayang banget gajadi beli, huhu :(");
    }

    public function calculateTotal(Request $request)
    {
        $cart = session('cart');
        $user = Auth::user();
        $pointsToRedeem = $request->input('points');

        // Cek apakah keranjang belanja kosong
        if (empty($cart)) {
            return response()->json(['error' => 'Keranjang belanja kosong.'], 400);
        }

        $grandTotal = array_sum(array_column($cart, 'sub_total')); // Total sebelum PPN

        // Cek apakah total belanjaan memenuhi syarat minimal
        if ($grandTotal < 100000) {
            return response()->json(['error' => 'Pembelanjaan minimal Rp. 100.000,- sebelum pajak.'], 400);
        }

        // Hitung PPN
        $ppn = $grandTotal * 0.11; // PPN 11%
        $grandTotal += $ppn; // Total setelah ditambah PPN

        // ambil data poin
        $userPoints = DB::table('memberships')
            ->where('users_id', $user->id)
            ->sum('points');

        // Konversi poin ke uang
        $pointsToMoney = $pointsToRedeem * 100000;

        // Cek apakah poin yang ditukarkan melebihi total belanja atau melebihi poin yang dipunya
        if ($pointsToRedeem > $userPoints) {
            return response()->json(['error' => 'Poin tidak cukup.'], 400);
        }
        elseif ($pointsToMoney > $grandTotal) {
            $maxPoints = floor($grandTotal / 100000);
            return response()->json(['error' => 'Poin yang ditukarkan melebihi total belanja. Maksimal poin yang dapat ditukarkan adalah ' . $maxPoints . '.'], 400);
        }

        // Hitung total setelah penukaran poin
        $grandTotalAfterPoints = $grandTotal - $pointsToMoney;

        return response()->json([
            'grandTotal' => number_format($grandTotal, 0, ',', '.'),
            'grandTotalAfterPoints' => number_format($grandTotalAfterPoints, 0, ',', '.'),
            'pointstomoney' => number_format($pointsToMoney, 0, ',', '.'),
            'pointsToRedeem' => $pointsToRedeem,
            'userPoints' => $userPoints
        ]);
    }
}
