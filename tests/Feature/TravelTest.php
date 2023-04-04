<?php

namespace Tests\Feature;

use App\Models\WeeklyPlan;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class TravelTest extends TestCase
{
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


    public function test_get_all_origin_response(): void
    {
        $response = $this->get('/api/origins');
        $response->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                "data" => [
                    [
                        "city" => "teh"
                    ],
                    [
                        "city" => "isf"
                    ]
                ]
            ]);
    }

    public function test_get_all_destination_response(): void
    {
        $response = $this->get('/api/destinations?city=teh');
        $response->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                "data" => [
                    [
                        "city" => "isf"
                    ]
                ]
            ]);
    }

    public function test_post_all_destination_response(): void
    {
        $payload = ['city' => 'teh'];
        $response = $this->post('/api/destinations', $payload);
        $response->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                "data" => [
                    [
                        "city" => "isf"
                    ]
                ]
            ]);
    }


    public function test_get_all_terminal(): void
    {
        $payload = ['city' => 'teh'];
        $response = $this->post('/api/terminals', $payload);

        $response->assertStatus(Response::HTTP_OK)
            ->assertExactJson([
                [
                    "city" => "teh",
                    "terminal" => "arg"
                ],
                [
                    "city" => "teh",
                    "terminal" => "jonob"
                ]
            ]);
    }
}
