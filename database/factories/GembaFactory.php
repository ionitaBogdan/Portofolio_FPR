<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gemba>
 */
class GembaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $locations = [
            'Office Building A',
            'Factory Floor B',
            'Warehouse C',
            'Retail Store D',
            'Distribution Center E',
            'Workshop F',
        ];

        $colors = [
            'Office Building A' => '#f78ef0',
            'Factory Floor B' => '#937df8',
            'Warehouse C' => '#6d9efc',
            'Retail Store D' => '#69ebfc',
            'Distribution Center E' => '#98f786',
            'Workshop F' => '#f3f87f',
        ];

        //$date = Carbon::createFromFormat('Y-m-d', $this->faker->unique()->dateTimeBetween('2024-01-01', '2024-12-31')->format('Y-m-01'));

        return [
            'date' => $this->faker->unique()->dateTimeBetween('2024-01-01', '2024-12-31'),
            'team_lead' => $this->faker->name(),
            'location' => $location = $this->faker->randomElement($locations),
            'color' => $colors[$location],
        ];
    }
}
