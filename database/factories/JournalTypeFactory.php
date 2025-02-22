<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JournalType>
 */
class JournalTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $thesisTypesEnglish = [
            'Academic Journals',
            'Medical Journals',
            'Scientific Journals',
        ];

        // Define Khmer translations in the same order
        $thesisTypesKhmer = [
            'Academic Journals',
            'Medical Journals',
            'Scientific Journals',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($thesisTypesEnglish) - 1);

        return [
            'name' => $thesisTypesEnglish[$index],
            'name_kh' => $thesisTypesKhmer[$index],
        ];
    }
}
