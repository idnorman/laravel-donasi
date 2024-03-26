<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $content = '';
        for ($i = 0; $i < 10; $i++) {
            $content = $content . '<p>' . $this->faker->paragraph(5, true) . '</p>';
        }
        return [
            'title' => $this->faker->sentence(15),
            'content' => $content,
            'image' => $this->faker->imageUrl(640, 360, 'cats', true),
            // 'image' => 'https://source.unsplash.com/random/640x360',
            'description' => $this->faker->sentence(),
        ];
    }
}
