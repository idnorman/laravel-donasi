<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProgramActivity>
 */
class ProgramActivityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $description = '';
        for ($i = 0; $i < 10; $i++) {
            $description = $description . '<p>' . $this->faker->paragraph(5, true) . '</p>';
        }
        return [
            'program_id' => \App\Models\Program::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence(),
            'description' => $description,
            'amount' => $this->faker->randomFloat(2, 1000, 5000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now')
        ];
    }
}
