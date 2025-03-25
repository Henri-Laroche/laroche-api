<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    protected $model = Profile::class;

    public function definition(): array
    {
        return [
            'admin_id'   => Admin::factory(), // Crée un admin si nécessaire
            'nom'        => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            // Pour l'image, on peut simuler un chemin de fichier
            'image'      => 'images/' . $this->faker->lexify('????????') . '.jpg',
            'status'     => $this->faker->randomElement(['inactif', 'en attente', 'actif']),
        ];
    }
}
