<?php

namespace App\Repositories;

use App\Models\WeeklyPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class WeeklyPlanRepository implements WeeklyPlanRepositoryInterface
{

    /** extract all unique origin_city
     * @return Builder|Collection|mixed
     */
    public function origins()
    {
        return WeeklyPlan::query()->distinct()->whereNotNull('origin_city_id')->get(['origin_city_id']);
    }

    /** extract all origin city to travel to this city
     * @param $city
     * @return mixed
     */
    public function destinations($city)
    {
        return WeeklyPlan::query()->where('destination_city_id', $city)->select('origin_city_id')->distinct()->get();
    }
}
