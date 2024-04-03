<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BusinessProfile>
 */
class BusinessProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => fake()->name(),
            'company_email' => fake()->unique()->safeEmail(),
            'website_url' => fake()->url(),
            'is_active' => fake()->boolean(),
            'custom_link_code' => str()->random(20),
        ];
    }
}
