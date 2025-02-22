<?php

namespace Database\Factories;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = \App\Models\NewsCategory::inRandomOrder()->first();
        $subCategory = $category->subCategories()->inRandomOrder()->first();

        // Check if $subCategory is null
        if (!$subCategory) {
            // If no subcategory is found, set it to null or handle it accordingly
            $subCategoryId = null;
        } else {
            $subCategoryId = $subCategory->id;
        }

        return [
            'name' => $this->faker->sentence,
            'year' => $this->faker->numberBetween(1980, 2024),
            'description' => $this->faker->paragraph,
            'image' => 'image.png',
            'publisher_id' => $this->faker->numberBetween(1, 10),
            'author_id' => $this->faker->numberBetween(1, 10),
            'language_id' => $this->faker->numberBetween(1, 2),
            'location_id' => $this->faker->numberBetween(1, 10),
            'news_type_id' => $this->faker->numberBetween(1, 10),
            'news_category_id' => $category->id,
            'news_sub_category_id' => $subCategoryId, // Use the $subCategoryId variable
            'create_by_user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}

