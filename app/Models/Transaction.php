<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    public function product()
    {
        return $this->belongsToMany(Product::class, 'products_transactions', 'products_id', 'transactions_id')
            ->withPivot('quantity', 'sub_total');;
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'membership', 'users_id', 'transactions_id')
            ->withPivot('points');
    }

    public function insertProducts($cart, $user)
    {
        $total = 0;
        foreach ($cart as $c) {
            # code...
            $subtotal = $c['quantity'] * $c['price'];
            $total += $subtotal;
            $this->products()->attach($c['id'], ['quantity' => $c['quantity'], 'sub_total' => $subtotal]);
        }
    }

    public function membership($cart, $user)
    {
        // $this->
    }
}
