<?php

namespace Tests\Feature;

use App\Models\Card;
use App\Models\User;
use Carbon\CarbonInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EndpointTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_match_day_returns_successful_resource()
    {
        $user = User::factory()->create();
        $response = $this
                ->actingAs($user, 'sanctum')
                ->withHeaders([ 'X-Requested-With' => 'XMLHttpRequest' ])
                ->post('api/match', [
            'where' => \fake()->address,
            'when' => \now()->addHours(4)->format(CarbonInterface::DEFAULT_TO_STRING_FORMAT)
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([ 'id', 'when', 'where']);
    }
    public function test_user_can_be_created_with_card(): void
    {
        $user = User::factory(1)->has(Card::factory())
            ->create();

        $this->assertEquals(1, $user->count());
        $this->assertEquals(1, Card::query()->get()->count());
    }
}
