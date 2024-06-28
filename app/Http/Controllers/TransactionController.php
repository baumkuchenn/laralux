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
        $t->save();

        //insert into junction table product_transaction using eloquent
        $t->insertProducts($cart, $user);

        //insert into junction table membership using eloquent
        $t->membership($cart, $user);

        session()->forget('cart');
        return redirect()->route('hotel.index')->with('status', 'Checkout berhasil');
    }
}
