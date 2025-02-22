<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Major>
 */
class MajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $thesisTypesEnglish = [
            'Computer Science',
            'Business',
            'Engineering',
        ];

        // Define Khmer translations in the same order
        $thesisTypesKhmer = [
            'វិទ្យាសាស្ត្រ​កុំព្យូទ័រ',
            'អាជីវកម្ម',
            'វិស្វកម្ម',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($thesisTypesEnglish) - 1);

        return [
            'name' => $thesisTypesEnglish[$index],
            'name_kh' => $thesisTypesKhmer[$index],
        ];
    }
}
