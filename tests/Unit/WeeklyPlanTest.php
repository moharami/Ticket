<?php

namespace Tests\Unit;

use App\Models\WeeklyPlan;
use App\Repositories\WeeklyPlanRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * @property $message
 */
class WeeklyPlanTest extends TestCase
{
    use RefreshDatabase;
    use HasFactory;


    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');
        $data = [
            [
                "origin_city_id" => "teh",
                "origin_terminal_id" => "jonob",
                "destination_city_id" => "tab",
                "destination_terminal_id" => "mark",
                "moving_day" => 3,
                "moving_hour" => 24000,
                "duration_minute" => 240,
                "capacity" => 30,
                "bus_type" => "bbbbb",
                "price" => 1500000,
            ],
            [
                "origin_city_id" => "isf",
                "origin_terminal_id" => "sofe",
                "destination_city_id" => "teh",
                "destination_terminal_id" => "arg",
                "moving_day" => 2,
                "moving_hour" => 23000,
                "duration_minute" => 120,
                "capacity" => 35,
                "bus_type" => "rrrrr",
                "price" => 2000000,
            ],
            [
                "origin_city_id" => "isf",
                "origin_terminal_id" => "sofe",
                "destination_city_id" => "teh",
                "destination_terminal_id" => "arg",
                "moving_day" => 2,
                "moving_hour" => 23000,
                "duration_minute" => 120,
                "capacity" => 35,
                "bus_type" => "rrrrr",
                "price" => 2000000,
            ],
        ];
        foreach ($data as $item) {
            $plan = WeeklyPlan::create($item);
            $plan->save();
        }
    }

    public function test_get_all_origin_and_unique(): void
    {
        $result = (new WeeklyPlanRepository)->origins()->toArray();
        $expect = [
            [
                "origin_city_id" => "teh"
            ],
            [
                "origin_city_id" => "isf"
            ],
        ];

        $this->assertEquals($result, $expect);
    }
}
