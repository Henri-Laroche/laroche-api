<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Profile;
use App\Models\Admin;

/**
 * @extends Factory<Profile>
 */
class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'image' => $this->faker->imageUrl(200, 200, 'people'), // À modifier pour stocker une vraie image
            'status' => $this->faker->randomElement(['inactive', 'pending', 'active']),
            'admin_id' => Admin::factory(), // Associe un admin à ce profil
        ];
    }
}
