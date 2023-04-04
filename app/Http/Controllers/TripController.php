<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\WeeklyPlan;
use App\Repositories\TripRepositoryInterface;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __construct(public TripRepositoryInterface $tripRepository)
    {
    }

    public function search(Request $request)
    {
        $t = WeeklyPlan::where('origin_city_id', $request->origin)
            ->orWhere('origin_terminal_id', $request->origin)
            ->where(function (Builder $query) {
                $query->where('destination_city_id', 'teh');
            })->get();
        dd($t);
        $t = Trip::first()->weeklyplan->toArray();
        dd($t);
        return $this->tripRepository->search('isf', 'teh', $request->time);

    }
}
