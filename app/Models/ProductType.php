<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductType extends Model
{
    protected $table = 'product_types';
    use HasFactory;
    use SoftDeletes;
    public function products():HasMany
    {
        return $this->hasMany(Product::class, 'producttype_id', 'id');
    }

    public function __toString()
    {
        return $this->nama;
    }
}
