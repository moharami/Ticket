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
}
