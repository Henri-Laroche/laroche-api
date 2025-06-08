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
            'admin_id'   => Admin::factory(), // Cria um admin se necessário
            'nom'        => $this->faker->lastName,
            'first_name' => $this->faker->firstName,
            // Para a imagem, podemos simular um caminho de arquivo
            'image'      => 'images/' . $this->faker->lexify('????????') . '.jpg',
            'status'     => $this->faker->randomElement(['inativo', 'pendente', 'ativo']),
        ];
    }
}
