<?php

namespace Database\Factories;

use App\Models\Concerns\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $positions = \collect(Position::values())->random(2);
        return [
            'primary_position'   => $positions->first(),
            'secondary_position' => $positions->last(),
            'pass'    => \rand(1,5),
            'shoot'   => \rand(1,5),
            'dribble' => \rand(1,5),
            'stamina' => \rand(1,5),
            'speed'   => \rand(1,5),
        ];
    }
}
