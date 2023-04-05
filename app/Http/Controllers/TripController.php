<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\WeeklyPlan;
use App\Repositories\TripRepositoryInterface;
use App\Repositories\WeeklyPlanRepositoryInterface;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function __construct(public TripRepositoryInterface $tripRepository, public WeeklyPlanRepositoryInterface $weeklyPlanRepository)
    {
    }

    public function search(Request $request)
    {
        return $this->weeklyPlanRepository->search($request->origin, $request->destination);
//        return $this->tripRepository->search('isf', 'teh', $request->time);
    }
}
