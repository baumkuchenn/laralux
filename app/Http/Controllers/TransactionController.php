<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

        return view('frontend.receipt')->with('status', 'Checkout berhasil');
    }
}
