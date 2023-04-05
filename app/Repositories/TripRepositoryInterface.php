<?php

namespace App\Repositories;

interface TripRepositoryInterface
{
    public function search($from, $to, $time);

    public function findTrip($id);

    public function saveReserve($trip_id, $seat_number);

    public function do_reserve($trip_id, $count, $seat_numbers);

    public function cancleExpiredReserve();

    public function cancle_reserve($reserve_id);

    public function undo_reserve($trip_id, $seats);


}
