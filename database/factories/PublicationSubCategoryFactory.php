<?php

namespace Database\Factories;

use App\Models\PublicationCategory;
use App\Models\PublicationSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PublicationSubCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublicationSubCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Retrieve all categories
        $categories = PublicationCategory::pluck('id')->toArray();

        // Define sub-categories based on categories
        $subCategories = [
            1 => ['Epic Fantasy', 'Urban Fantasy', 'High Fantasy', 'Low Fantasy'],
            2 => ['Self-Help', 'Biography', 'Memoir', 'History', 'Science'],
            3 => ['Space Opera', 'Cyberpunk', 'Hard Science Fiction', 'Dystopian'],
            4 => ['Romantic Comedy', 'Historical Romance', 'Paranormal Romance', 'Erotic Romance'],
            5 => ['Psychological Thriller', 'Legal Thriller', 'Cozy Mystery', 'Police Procedural'],
            6 => ['Science Fiction', 'Non-Fiction', 'Fiction', 'Adventure'],
            7 => ['Healthy Eating', 'Vegetarian Cooking', 'Vegan Cooking', 'Desserts'],
            8 => ['Startup Business', 'Leadership', 'Motivational', 'Success Stories'],
            9 => ['Health and Fitness', 'Personal Development', 'Relationships', 'Mindfulness'],
            10 => ['DIY Projects', 'Gardening', 'Home Improvement', 'Crafts'],
        ];

        // Get a random category ID
        $categoryId = $this->faker->randomElement($categories);

        // Get sub-categories for the selected category
        $subcategoryNames = $subCategories[$categoryId] ?? [];

        // Choose a random sub-category name
        $subcategoryName = $this->faker->randomElement($subcategoryNames);

        return [
            'name' => $subcategoryName,
            'publication_category_id' => $categoryId,
        ];
    }
}
