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
}
