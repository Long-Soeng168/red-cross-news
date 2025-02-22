<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WebsiteInfo>
 */
class WebsiteInfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'E-Library',
            'name_kh' => 'បណ្ណាល័យអេឡិចត្រូនិច',
            'image' => 'logo.png',
            'banner' => 'banner.png',
            'primary' => '#377eb4',
            'primary_hover' => '#206fac',
        ];
    }
}
