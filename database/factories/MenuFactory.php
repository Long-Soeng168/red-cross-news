<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
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
            'About Us',
            'Contact',
            'ELibrary Guide',
        ];

        // Define Khmer translations in the same order
        $languageNameKhmer = [
            'អំពីយើង',
            'ទំនាក់ទំនង',
            'របៀបប្រើប្រាស់បណ្ណាល័យអេឡិចត្រូនិច',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($languageName) - 1);

        return [
            'name' => $languageName[$index],
            'name_kh' => $languageNameKhmer[$index],
            'description' => $this->faker->paragraph,
        ];
    }
}
