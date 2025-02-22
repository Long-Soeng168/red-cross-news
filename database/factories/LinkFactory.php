<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Define the desired order of publication types
        $linkName = [
            'Facebook',
            'Youtube',
            'Telegram',
        ];

        // Define Khmer translations in the same order
        $linkNameKhmer = [
            'ហ្វេសប៊ុក',
            'យូធូប',
            'តេឡេក្រាម',
        ];
        $links = [
            'https://facebook.com/',
            'https://youtube.com/',
            'https://telegram.org/',
        ];
        $images = [
            'facebook.png',
            'youtube.png',
            'telegram.png',
        ];

        // Generate an index to use for retrieving both English and Khmer names
        $index = $this->faker->unique()->numberBetween(0, count($linkName) - 1);

        return [
            'name' => $linkName[$index],
            'name_kh' => $linkNameKhmer[$index],
            'image' => $images[$index],
            'link' => $links[$index],
        ];
    }
}
