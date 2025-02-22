<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NewsType>
 */
class NewsTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $newsTypesEnglish = [
            'Journal',
            'Book',
            'Magazine',
        ];

        // Define Khmer translations in the same order
        $newsTypesKhmer = [
            'ទិនានុប្បវត្តិ',
            'សៀវភៅ',
            'ទស្សនាវដ្តី',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($newsTypesEnglish) - 1);

        return [
            'name' => $newsTypesEnglish[$index],
            'name_kh' => $newsTypesKhmer[$index],
        ];
    }
}
