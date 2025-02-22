<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageCategory>
 */
class ImageCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = ['Science Fiction', 'Fantasy', 'Thriller', 'Mystery', 'Romance', 'Biography', 'Self-Help', 'Cookbook'];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
        ];
    }
}
