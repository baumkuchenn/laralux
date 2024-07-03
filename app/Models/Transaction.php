<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function product()
    {
        return $this->belongsToMany(Product::class, 'products_transactions', 'transactions_id', 'products_id')
            ->withPivot('quantity', 'sub_total');;
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'memberships', 'users_id', 'transactions_id')
            ->withPivot('points');
    }

    public function insertProducts($cart, $t_id)
    {
        foreach ($cart as $c) {
            $subtotal = $c['quantity'] * $c['price'];

            // Debugging
            // dd($t_id);
            $this->product()->attach($c['id'], ['quantity' => $c['quantity'], 'sub_total' => $subtotal, 'transactions_id' => $t_id]);
        }
    }

    public function membership($sumber, $cart, $user, $t_id, $redeemedPoints)
    {
        $membership = new Membership();
        if ($sumber == "transaksi") {
            $points = $this->calculatePoints($cart); // Calculate points based on cart items
            $membership->users_id = $user->id;
        } else {
            $points = 0;
            $membership->users_id = $user;
        }
        // dd($points);
        // Create or update membership record for the user
        // $membership = Membership::where('users_id', $user->id)->first();
        
        $membership->transactions_id = $t_id;
        $membership->points += $points;
        $membership->redeempoints = $redeemedPoints;
        $membership->save();
    }

    public function calculatePoints($cart)
    {
        $points = 0;

        foreach ($cart as $c) {
            $product = Product::find($c['id']);

            if ($product->producttype_id == 2 || $product->producttype_id == 3) {
                // Jika produk bertipe deluxe, superior, atau suite
                $points += 5 * $c['quantity'];
            } else {
                // Jika produk tidak bertipe deluxe, superior, atau suite
                $points += floor($c['sub_total'] / 300000); // Konversi pembelian menjadi poin
            }
        }

        return $points;
    }

    public function redeemPoints($points, $total)
    {
        $redeemableAmount = $points * 100000;

        if ($redeemableAmount <= $total) {
            // Potong poin dari total transaksi
            return $total - $redeemableAmount;
        } else {
            // Jika poin yang dapat diredeem lebih besar dari total transaksi
            return 0; // atau throw exception sesuai kebijakan bisnis
        }
    }
}
