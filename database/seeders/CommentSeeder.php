<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Profile;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // Pour chaque profile, créer un commentaire de l'admin qui a créé le profile
        $profiles = Profile::all();

        foreach ($profiles as $profile) {
            // On vérifie qu'un commentaire n'existe pas déjà si besoin (règle métier)
            Comment::factory()->create([
                'profile_id' => $profile->id,
                'admin_id'   => $profile->admin_id,
            ]);
        }
    }
}
