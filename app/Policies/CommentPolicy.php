<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Profile;

class CommentPolicy
{
    /**
     * Verifique claramente se o administrador pode adicionar um comentário a um determinado perfil.
     */
    public function create(Admin $admin, Profile $profile): bool
    {
        // Use as relações definidas em vez de uma consulta bruta.
        return !$profile->comments()->where('admin_id', $admin->id)->exists();
    }
}
