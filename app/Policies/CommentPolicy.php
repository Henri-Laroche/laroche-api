<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\Profile;

class CommentPolicy
{
    /**
     * Vérifie si l'administrateur peut ajouter un commentaire à un profil donné.
     */
    public function create(Admin $admin, Profile $profile): bool
    {
        return !Comment::where('profile_id', $profile->id)
            ->where('admin_id', $admin->id)
            ->exists();
    }
}
