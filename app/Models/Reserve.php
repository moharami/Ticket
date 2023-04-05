<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    use HasFactory;

    protected $fillable = ['trip_id', 'count', 'seat_numbers'];

    public function getSeatNumbersAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setSeatNumbersAttribute($value)
    {
        $this->attributes['seat_numbers'] = json_encode($value);
    }
}
