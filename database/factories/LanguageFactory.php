<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define the desired order of publication types
        $languageName = [
            'Khmer',
            'English',
        ];

        // Define Khmer translations in the same order
        $languageNameKhmer = [
            'ខ្មែរ',
            'អង់គ្លេស',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($languageName) - 1);

        return [
            'name' => $languageName[$index],
            'name_kh' => $languageNameKhmer[$index],
        ];
    }
}
