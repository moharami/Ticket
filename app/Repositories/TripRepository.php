<?php

namespace App\Repositories;

use App\Models\Reserve;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\throwException;

class TripRepository implements TripRepositoryInterface
{

    /** find a path between two city in certain time
     * @param $from
     * @param $to
     * @param $time
     * @return Builder|Collection
     */
    public function search($from, $to, $time)
    {
        return Trip::query()->where('moving_date', date('Y-m-d H:i:s', $time))->get();
    }

    public function findTrip($id)
    {
        return Trip::findOrFail($id);
    }


    public function saveReserve($trip_id, $seat_numbers)
    {
        try {
            $trip = $this->findTrip($trip_id);
            $available = collect($trip->available_seats)->diff($seat_numbers);
            $trip->available_seats = $available->values();
            $trip->reserve_seats = collect($trip->reserve_seats)->merge($seat_numbers)->values();
            $trip->save();

        } catch (\Exception $exception) {
            throwException('not save successfull');
        }
    }


    public function do_reserve($trip_id, $count, $seat_numbers)
    {
        return DB::transaction(function () use ($trip_id, $count, $seat_numbers) {
            $this->saveReserve($trip_id, $seat_numbers);
            return Reserve::create([
                'trip_id' => $trip_id,
                'count' => $count,

                'seat_numbers' => $seat_numbers
            ])->id;

        });

    }
}
