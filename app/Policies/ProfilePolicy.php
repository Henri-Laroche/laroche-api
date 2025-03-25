<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Profile;

class ProfilePolicy
{
    /**
     * Vérifie si l'administrateur peut créer un profil.
     */
    public function create(Admin $admin): bool
    {
        // Autoriser tous les admins à créer un profil.
        return true;
    }

    /**
     * Vérifie si l'administrateur peut mettre à jour le profil.
     */
    public function update(Admin $admin, Profile $profile): bool
    {
        // Autoriser uniquement si l'admin est propriétaire du profil.
        // - préfère comme ça
        //return $admin->id === $profile->admin_id;

        // Autorise tous les admins
        return true;
    }

    /**
     * Vérifie si l'administrateur peut supprimer le profil.
     */
    public function delete(Admin $admin, Profile $profile): bool
    {
       // Autoriser uniquement si l'admin est propriétaire du profil.
        // - préfère comme ça
        //return $admin->id === $profile->admin_id;

        // Autorise tous les admins
        return true;

    }
}
