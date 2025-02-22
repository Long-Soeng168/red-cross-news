<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ThesisType>
 */
class ThesisTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $thesisTypesEnglish = [
            'Ba',
            'Master',
            'Phd',
        ];

        // Define Khmer translations in the same order
        $thesisTypesKhmer = [
            'បរិញ្ញាបត្រ',
            'អនុបណ្ឌិត',
            'បណ្ឌិត',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($thesisTypesEnglish) - 1);

        return [
            'name' => $thesisTypesEnglish[$index],
            'name_kh' => $thesisTypesKhmer[$index],
        ];
    }
}
