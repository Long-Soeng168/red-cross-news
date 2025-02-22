<?php

namespace Database\Factories;

use App\Models\PublicationCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicationCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['Fiction', 'Non-Fiction', 'Science Fiction', 'Fantasy', 'Thriller', 'Mystery', 'Romance', 'Biography', 'Self-Help', 'Cookbook'];

        return [
            'name' => $this->faker->unique()->randomElement($categories),
        ];
    }
}
