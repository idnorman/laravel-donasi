<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Program>
 */
class ProgramFactory extends Factory
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
            'name' => $this->faker->sentence(),
            'description' => $description,
            // 'image' => $this->faker->imageUrl(640, 360, 'cats', true),
            'image' => 'https://source.unsplash.com/random/640x360/?poor kids' . rand(1, 100),
            'target_fund' => $this->faker->randomFloat(2, 1000000, 3000000),
        ];
    }
}
