<?php

namespace App\Repositories;

use App\Models\Reserve;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
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

    /** based on id provided, find or fail trip
     * @param $id
     * @return mixed
     */
    public function findTrip($id)
    {
        return Trip::findOrFail($id);
    }


    /** recive an array of seats and put this seat in reserve mode
     * and remove seats from availbale_seat so that anthor request can't
     * reserve this seats
     * @param $trip_id
     * @param $seat_numbers
     * @return void
     */
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


    /** first it put seat numbers unavailbale
     * then create one record in reserve table
     * @param $trip_id
     * @param $count
     * @param $seat_numbers
     * @return mixed
     */
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


    /** check all of reserve row and if the time passed
     * more than 15 minute( we put it in config)
     * turn the reserve to cancle
     * @return string
     */
    public function cancleExpiredReserve()
    {
        $minutes = Config::get('ticket.minute_cancle');
        $reservers = Reserve::where('created_at', '<', Carbon::now()->subMinute($minutes))->get();
        foreach ($reservers as $reserve) {
            $this->cancle_reserve($reserve->id);
        }
        return count($reservers) . 'reserved cancled ';

    }

    /** base on id provided, first turn reserve to cancle
     * then make every seats in this reserve to available seats
     * @param $reserve_id
     * @return void
     */
    public function cancle_reserve($reserve_id)
    {
        DB::transaction(function () use ($reserve_id) {
            $reserve = Reserve::findOrFail($reserve_id);
            $seat = $this->cancle($reserve_id);
            $this->undo_reserve($reserve->trip_id, $seat);

        });
    }


    /** turn cancle flag to true
     * @param $reserve_id
     * @return mixed
     */
    public function cancle($reserve_id)
    {
        $trip = Reserve::findOrFail($reserve_id);
        $trip->cancle = true;
        $trip->save();
        return $trip->seat_numbers;
    }

    /** recive one trip id and array of seats
     * first remove seats from reserve and make it free
     * then put this seats to available seats
     * @param $trip_id
     * @param $seats
     * @return void
     */
    public function undo_reserve($trip_id, $seats)
    {
        try {
            $trip = Trip::findOrFail($trip_id);
            $trip->available_seats = collect($trip->available_seats)->merge($seats)->unique();
            $trip->reserve_seats = $available = collect($trip->reserve_seats)->diff($seats);
            $trip->save();
        } catch (\Exception $exception) {
            throw new Exception('not saved');
        }
    }

}
