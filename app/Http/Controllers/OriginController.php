<?php

namespace App\Http\Controllers;

use App\Http\Resources\OriginResource;
use App\Models\WeeklyPlan;
use Illuminate\Http\Request;

class OriginController extends Controller
{
    public function index()
    {
        $data = WeeklyPlan::select('origin_city_id')->distinct()->get();
        return OriginResource::collection($data);
    }

    public function show($name)
    {
        $data = WeeklyPlan::where('origin_city_id', $name)->get();
        return OriginResource::collection($data);

    }
}
