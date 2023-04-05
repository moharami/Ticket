<?php

namespace App\Http\Controllers;

use App\Http\Requests\CancleRequest;
use App\Http\Requests\ReserveRequest;
use App\Models\Reserve;
use App\Models\Trip;
use App\Repositories\TripRepository;
use App\Repositories\TripRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class ReserveController extends Controller
{
    public function index(ReserveRequest $request, TripRepositoryInterface $tripRepository)
    {
        //validate
        $request->seat_numbers = json_decode($request->seat_numbers);
        $trip = $tripRepository->findTrip($request->trip_id);
        if (count($request->seat_numbers) != $request->count) {
            abort(400, 'bad request');
        }
        $this->is_availableSeat($request->seat_numbers, $trip->available_seats);

        $id = $tripRepository->do_reserve($request->trip_id, $request->count, $request->seat_numbers);
        return response()->json(['reserve_number' => $id, 'message' => 'succesfull reserved'], 201);


    }

    private function is_availableSeat($seat_numbers, $available_seats)
    {
        foreach ($seat_numbers as $seat) {
            if (!in_array($seat, $available_seats)) {
                abort(400, 'Your Seat is not availbale');
            }
        }

        return true;
    }

    public function cancle(CancleRequest $request, TripRepositoryInterface $tripRepository)
    {
        $tripRepository->cancle_reserve($request->trip_id);
        return response()->json(['message' => ' reserve cancled successfull'], 200);
    }
    
}
