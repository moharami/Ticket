<?php

namespace App\Http\Controllers;

use App\Http\Resources\OriginResource;
use App\Models\WeeklyPlan;
use App\Repositories\WeeklyPlanRepositoryInterface;
use Carbon\Traits\Week;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TravelController extends Controller
{
    /**
     * @param WeeklyPlanRepositoryInterface $weeklyPlanRepository
     */
    public function __construct(public WeeklyPlanRepositoryInterface $weeklyPlanRepository)
    {

    }

    /** return all origins from weeklyplan
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        return OriginResource::collection($this->weeklyPlanRepository->origins());
    }

    public function show($name)
    {
        $data = WeeklyPlan::where('origin_city_id', $name)->get();
        return OriginResource::collection($data);

    }
}
