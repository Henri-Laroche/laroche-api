<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Vous pouvez ajouter une logique d'autorisation ici.
        return true;
    }

    /**
     * Retourne les règles de validation pour la mise à jour d'un profil.
     *
     * Utiliser "sometimes|required" permet une mise à jour partielle.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nom' => 'sometimes|required|string|max:255',
            'first_name' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string', // ou 'sometimes|required|image' si vous gérez un fichier
            'status' => 'sometimes|required|in:inactif,en attente,actif',
        ];
    }
}
