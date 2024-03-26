<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => \Str::uuid(),
            'program_id' => \App\Models\Program::inRandomOrder()->first()->id,
            'donatur_id' => \App\Models\User::role('donatur')->inRandomOrder()->first()->id,
            'amount' => $this->faker->randomFloat(2, 10000, 100000),
            'is_hide_name' => $this->faker->randomElement([0, 1]),
            'payment_status' => 2,
            'snap_token' => \Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
