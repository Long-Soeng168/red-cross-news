<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ImageType>
 */
class ImageTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imageTypesEnglish = [
            'Journal',
            'Book',
            'Magazine',
        ];

        // Define Khmer translations in the same order
        $imageTypesKhmer = [
            'ទិនានុប្បវត្តិ',
            'សៀវភៅ',
            'ទស្សនាវដ្តី',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($imageTypesEnglish) - 1);

        return [
            'name' => $imageTypesEnglish[$index],
            'name_kh' => $imageTypesKhmer[$index],
        ];
    }
}
