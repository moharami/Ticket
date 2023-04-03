<?php

namespace Database\Seeders;

use App\Models\WeeklyPlan;
use Database\Factories\WeeklyPlanFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WeeklyPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WeeklyPlan::factory()->count(50)->create();

    }
}
