<?php

namespace App\Console\Commands;

use App\Repositories\TripRepositoryInterface;
use Illuminate\Console\Command;

class cancleReserve extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reserve:cancle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cancle All Expire Reservation';

    /**
     * Execute the console command.
     */
    public function handle(TripRepositoryInterface $tripRepository): void
    {
       $tripRepository->cancleExpiredReserve();
    }
}
