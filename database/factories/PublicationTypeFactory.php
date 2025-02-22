<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PublicationType>
 */
class PublicationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define the desired order of publication types
        $publicationTypesEnglish = [
            'Journal',
            'Book',
            'Magazine',
            'Newspaper',
            'Newsletter',
            'E-book',
            'Report',
            'Manual',
            'Brochure',
            'Thesis'
        ];

        // Define Khmer translations in the same order
        $publicationTypesKhmer = [
            'ទិនានុប្បវត្តិ',
            'សៀវភៅ',
            'ទស្សនាវដ្តី',
            'កាសែត',
            'ព្រឹត្តិបត្រ',
            'សៀវភៅអេឡិចត្រូនិច',
            'របាយការណ៍',
            'ហត្ថកម្ម',
            'ខិត្តប័ណ្ណ',
            'និក្ខេបបទ'
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($publicationTypesEnglish) - 1);

        return [
            'name' => $publicationTypesEnglish[$index],
            'name_kh' => $publicationTypesKhmer[$index],
        ];
    }
}
