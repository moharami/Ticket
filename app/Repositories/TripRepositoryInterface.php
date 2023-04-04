<?php

namespace App\Repositories;

interface TripRepositoryInterface
{
    public function search($from, $to , $time);

}
