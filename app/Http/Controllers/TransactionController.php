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
        $user = Auth::user();
        $t = new Transaction();

        $t->transaction_date = Carbon::now()->toDateTimeString();
        // $t->save();

        // Insert into junction table product_transaction using eloquent
        $t->insertProducts($cart, $user);
        $t->membership($cart, $user);

        // Calculate points based on cart contents
        $points = $t->calculatePoints($cart);

        // Redeem points if applicable
        $grandTotal = array_sum(array_column($cart, 'sub_total')); // Total sebelum PPN
        $grandTotal = $t->redeemPoints($points, $grandTotal);

        // Hitung PPN
        $ppn = $grandTotal * 0.11; // PPN 11%
        $grandTotal += $ppn; // Total setelah ditambah PPN

        // Simpan total dan poin member ke dalam transaksi
        $t->total = $grandTotal;
        $t->save();

        // Clear cart
        session()->forget('cart');

        return redirect()->route('hotel.index')->with('status', 'Checkout berhasil');
    }
}
