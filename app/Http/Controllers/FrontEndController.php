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
}
