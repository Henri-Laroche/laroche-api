<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Profile;

class CommentPolicy
{
    /**
     * Vérifie clairement si l'administrateur peut ajouter un commentaire à un profil donné.
     */
    public function create(Admin $admin, Profile $profile): bool
    {
        // utilise les relations définies plutôt qu'une requête brute.
        return !$profile->comments()->where('admin_id', $admin->id)->exists();
    }
}
