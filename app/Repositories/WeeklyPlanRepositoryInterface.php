<?php

namespace App\Repositories;

interface WeeklyPlanRepositoryInterface
{
    /** all origin
     * @return mixed
     */
    public function origins();

    public function destinations($city);
}
