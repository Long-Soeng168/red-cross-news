<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalCategory>
 */
class JournalCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $thesisCategoryEnglish = [
            'Artificial Intelligence in Healthcare',
            'Cybersecurity in the Age of Quantum Computing',
            'Blockchain Technology',
            'Internet of Things (IoT) and Smart Cities',
        ];

        // Define Khmer translations in the same order
        $thesisCategoryKhmer = [
            'បញ្ញាសិប្បនិម្មិតក្នុងការថែទាំសុខភាព',
            'សន្តិសុខតាមអ៊ីនធឺណិតក្នុងយុគសម័យនៃ Quantum Computing',
            'បច្ចេកវិទ្យា Blockchain',
            'Internet of Things (IoT) និងទីក្រុងឆ្លាតវៃ',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($thesisCategoryEnglish) - 1);

        return [
            'name' => $thesisCategoryEnglish[$index],
            'name_kh' => $thesisCategoryKhmer[$index],
        ];
    }
}
