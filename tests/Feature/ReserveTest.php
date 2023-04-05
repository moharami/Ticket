<?php

namespace Tests\Feature;

use App\Models\Trip;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class ReserveTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate:refresh');

        Trip::create([
            'weekly_plan_id' => 1,
            'moving_date' => '2023-04-04 17:00:00',
            'available_seats' => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18],
            'reserve_seats' => [19, 20],
            'is_available' => true
        ]);

    }

    /**
     * A basic feature test example.
     */
    public function test_save_reserve(): void
    {
        $payload = ['trip_id' => 1, 'count' => 2, 'seat_numbers' => json_encode([1, 2])];
        $response = $this->post('/api/reserve', $payload);
        $response->assertStatus(Response::HTTP_CREATED);
    }


    public function test_not_match_count_and_seats(): void
    {
        $payload = ['trip_id' => 1, 'count' => 3, 'seat_numbers' => json_encode([1, 2])];
        $response = $this->post('/api/reserve', $payload);
        $response->assertStatus(Response::HTTP_BAD_REQUEST);
    }
}
