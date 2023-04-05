<?php

namespace App\Repositories;

use App\Models\Trip;

class TripRepository implements TripRepositoryInterface
{

    public function search($from, $to, $time)
    {
        return Trip::query()->where('moving_date', date('Y-m-d H:i:s', $time))->get();
    }
}
