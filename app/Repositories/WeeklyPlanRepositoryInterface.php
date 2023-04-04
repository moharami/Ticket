<?php

namespace App\Repositories;

interface WeeklyPlanRepositoryInterface
{
    /** all origin
     * @return mixed
     */
    public function origins();

    public function destinations($city);

    /** return all terminal in one city
     * @param $city
     * @return mixed
     */
    public function terminals($city);
}
