<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Profile;

class ProfilePolicy
{
    /**
     * Verifique se o administrador pode criar um perfil.
     */
    public function create(Admin $admin): bool
    {
        // Autoriser tous les admins à créer un profil.
        return true;
    }

    /**
     * Verifique se o administrador pode atualizar o perfil.
     */
    public function update(Admin $admin, Profile $profile): bool
    {
        // Prefiro assim: Permitir somente se o administrador for o proprietário do perfil.

        //return $admin->id === $profile->admin_id;

        // Permitir todos os administradores.
        return true;
    }

    /**
     * Verifique se o administrador pode excluir o perfil.
     */
    public function delete(Admin $admin, Profile $profile): bool
    {
        // Prefiro assim: permitir somente se o administrador for o proprietário do perfil.

        //return $admin->id === $profile->admin_id;

        // Permitir todos os administradores.
        return true;

    }
}
