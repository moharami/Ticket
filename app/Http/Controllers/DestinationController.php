<?php

namespace App\Http\Controllers;

use App\Http\Resources\DestinationResource;
use App\Http\Resources\TerminalResource;
use App\Models\WeeklyPlan;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DestinationController extends Controller
{
    public function show($name)
    {
        $data = WeeklyPlan::where('destination_city_id', $name)->get();
        return DestinationResource::collection($data);
    }

    /**
     * @param $city
     * @return AnonymousResourceCollection
     */
    public function terminal($city)
    {
        $from = WeeklyPlan::where('destination_city_id', $city)->select('destination_terminal_id')->distinct()->get();
//        $to = WeeklyPlan::where('origin_city_id', $city)->select('origin_terminal_id')->distinct()->get();
        return TerminalResource::collection($from);
    }
}
