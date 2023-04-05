<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['weekly_plan_id', 'moving_date', 'available_seats', 'reserve_seats', 'is_available'];



    public function weeklyplan(): BelongsTo
    {
        return $this->belongsTo(WeeklyPlan::class, 'weekly_plan_id');
    }


    public function getAvailableSeatsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setAvailableSeatsAttribute($value)
    {
        $this->attributes['available_seats'] = json_encode($value);
    }


    public function getReserveSeatsAttribute($value)
    {
        return json_decode($value, true);
    }

    public function setReserveSeatsAttribute($value)
    {
        $this->attributes['reserve_seats'] = json_encode($value);
    }
}
