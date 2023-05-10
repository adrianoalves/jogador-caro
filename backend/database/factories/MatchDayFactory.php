<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MatchDay>
 */
class MatchDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'when' => \now()->addHours(12),
            'where' => fake()->address()
        ];
    }

    public function match_day_in_past(): Factory
    {
        return $this->state( function( array $attributes ) {
            return [
                'when' => \now()
            ];
        });

    }
}
