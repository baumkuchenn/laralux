<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
            ];
        } else {
            $cart[$id]['quantity']++;
        }

        $cartItemCount = array_sum(array_column($cart, 'quantity'));
        session()->put('cart', $cart);
        session()->put('cartItemCount', count(session()->get('cart')));
        return redirect()->back()->with("status", "Produk berhasil ditambahkan ke Cart")->with('cartItemCount', $cartItemCount);;
    }

    public function cart()
    {
        return view('frontend.cart');
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
        return redirect()->back()->with("status", "Produk berhasil dihapus dari Cart");
    }
}
