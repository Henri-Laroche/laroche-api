<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Profile;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // Para cada perfil, criar um comentário do admin que criou o perfil
        $profiles = Profile::all();

        foreach ($profiles as $profile) {
            // Verificamos se um comentário já não existe, se necessário (regra de negócio)
            Comment::factory()->create([
                'profile_id' => $profile->id,
                'admin_id'   => $profile->admin_id,
            ]);
        }
    }
}
