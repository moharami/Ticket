<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WeeklyPlan>
 */
class WeeklyPlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $cities = [
            'teh' =>
                [
                    'jonob',
                    'argan'
                ],
            'isf' => [
                'kave',
                'sofe'
            ],
            'tab' => [
                'mark',
                'shom'
            ],
            'masha' => [
                'meraj',
                'emam',
                'abri'
            ]
        ];
        $city_from = Arr::random(array_keys($cities));
        $terminal_from = Arr::random(array_values($cities[$city_from]));

        $cities_to = Arr::except($cities, $city_from);

        $city_to = Arr::random(array_keys($cities_to));
        $terminal_to = Arr::random(array_values($cities_to[$city_to]));


        return [
            "origin_city_id" => $city_from,
            "origin_terminal_id" => $terminal_from,
            "destination_city_id" => $city_to,
            "destination_terminal_id" => $terminal_to,
            "moving_day" => rand(0, 7),
            "moving_hour" => rand(0, 12 * 60 * 60),
            "duration_minute" => rand(0, 360),
            "capacity" => rand(20, 35),
            "bus_type" => Str::random(5),
            "price" => round(rand(500000, 2000000), -4)
        ];
    }
}
