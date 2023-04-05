<?php

namespace App\Repositories;

use App\Models\WeeklyPlan;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
        $result = WeeklyPlan::query()->where('destination_city_id', $city)->select('origin_city_id')->distinct()->get();

        return $this->returnResult($result);
    }

    public function terminals($city, $destination = true)
    {
        $city_var = $destination ? 'destination_city_id' : 'origin_city_id';
        $terminal_var = $destination ? 'destination_terminal_id' : 'origin_terminal_id';
        $result = WeeklyPlan::query()->where($city_var, $city)
            ->groupBy($terminal_var)
            ->select([$city_var . ' as city', $terminal_var . ' as terminal'])
            ->get();

        return $this->returnResult($result);

    }

    public function returnResult(Collection|array $result)
    {
        if (count($result) > 0) {
            return $result;
        }
        throw new ModelNotFoundException('Not Found Resource');
    }

    /** search path between two city
     * @param $origin
     * @param $destination
     * @return mixed
     */
    public function search($origin, $destination)
    {
        return WeeklyPlan::whereRaw('(origin_city_id = ? or origin_terminal_id = ? ) and (destination_city_id = ? or destination_terminal_id = ? )', [$origin,$origin, $destination, $destination])->get();
    }
}
