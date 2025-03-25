<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Profile;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'profile_id' => Profile::factory(), // Crée un profil si nécessaire
            'admin_id'   => Admin::factory(),   // Crée un admin si nécessaire
            'content'    => $this->faker->paragraph,
        ];
    }
}
