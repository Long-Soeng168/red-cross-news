<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Footer>
 */
class FooterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => 'Contact Us',
            'name_kh' => 'ទំនាក់ទំនង',
            'description' =>   '<p>
                                    Building (5th Floor), St,National Assembly, Sangkat
                                    Tonle Basac, Khan Chamka Mon, Phnom Penh, Cambodia
                                    <span><a href="#">Google Maps</a></span>
                                </p>
                                <p>Phone Number : +855 99 999 999</p>
                                <p>Email : admin@email.kh</p>',
        ];
    }
}
