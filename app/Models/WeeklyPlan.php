<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeeklyPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        "origin_city_id",
        "origin_terminal_id",
        "destination_city_id",
        "destination_terminal_id",
        "moving_day",
        "moving_hour",
        "duration_minute",
        "capacity",
        "bus_type",
        "price"
    ];

    public function Trips(): HasMany
    {
        return $this->hasMany(Trip::class);
    }
}
