<?php

namespace Database\Seeders;

use App\Models\Trip;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TripSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trip::create([
            'weekly_plan_id' => 1,
            'moving_date' => '2023-04-04 17:00:00',
            'total_capacity' => 40,
            'remain_capacity' => 40,
            'available' => true
        ]);
    }
}
