<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory;
    use SoftDeletes;
    public function type(): BelongsTo{
        return $this->belongsTo(HotelType::class, 'hoteltype_id');
    }
    public function typeWithTrashed(){
        return $this->belongsTo('App\Models\HotelType')->withTrashed();
    }
    public function product(){
        return $this->hasMany('App\Models\Product');
    }
}
