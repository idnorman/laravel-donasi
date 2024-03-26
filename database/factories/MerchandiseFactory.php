<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchandise>
 */
class MerchandiseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(0, 10000, 100000),
            'image' => $this->faker->imageUrl(640, 480, 'animals', true),
            'description' => $this->faker->text,
            'stock' => $this->faker->numberBetween(0, 100),
        ];
    }
}
