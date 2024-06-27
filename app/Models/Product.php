<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function hotels(){
        return $this->belongsTo('App\Models\Hotel');
    }
    public function types(){
        return $this->belongsTo('App\Models\ProductType');
    }
    public static function retrieveByHotelId($id)
    {
        $data = self::where('hotel_id', $id)->get();
        return $data;
    }
    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'fasilitas_product', 'product_id', 'fasilitas_id');
    }
}
