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

    public function terminals($city, $destination = true)
    {
        $city_var = $destination ? 'destination_city_id' : 'origin_city_id';
        $terminal_var = $destination ? 'destination_terminal_id' : 'origin_terminal_id';
        return WeeklyPlan::query()->where($city_var, $city)
            ->groupBy($terminal_var)
            ->select([$city_var . ' as city', $terminal_var . ' as terminal'])
            ->get();
    }
}
