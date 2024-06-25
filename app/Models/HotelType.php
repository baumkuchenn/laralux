<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotelType extends Model
{
    protected $table = 'hotel_types';
    use HasFactory;
    use SoftDeletes;
    public function hotel():HasMany
    {
        return $this->hasMany(Hotel::class, 'hoteltype_id', 'id');
    }

    public function __toString()
    {
        return $this->nama;
    }
}
