<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Predefined list of Khmer city names
        $khmerCities = [
            'ភ្នំពេញ',
            'បាត់ដំបង',
            'កំពង់ស្ពឺ',
            'កំពង់ចាម',
            'កំពង់សីលធម៌',
            'ប៉ៃលិន',
            'កំពង់សោម',
            'កែប',
            'សៀមរាប',
            'កំពត',
        ];



        return [
            'name' => $this->faker->unique()->randomElement($khmerCities), // Generate a random Khmer city name
            // Or you can specify a Khmer state
        ];
    }
}
