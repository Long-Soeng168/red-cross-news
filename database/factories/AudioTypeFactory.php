<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AudioType>
 */
class AudioTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $audioTypesEnglish = [
            'Journal',
            'Book',
            'Magazine',
        ];

        // Define Khmer translations in the same order
        $audioTypesKhmer = [
            'ទិនានុប្បវត្តិ',
            'សៀវភៅ',
            'ទស្សនាវដ្តី',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($audioTypesEnglish) - 1);

        return [
            'name' => $audioTypesEnglish[$index],
            'name_kh' => $audioTypesKhmer[$index],
        ];
    }
}
