<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fasilitas extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function products(){
        return $this->belongsToMany(Product::class, 'fasilitas_product', 'fasilitas_id', 'product_id');
    }
}
