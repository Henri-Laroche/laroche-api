<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à faire cette requête.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Retournez true pour autoriser tous les utilisateurs authentifiés (ou appliquez votre logique)
        return true;
    }

    /**
     * Définit les règles de validation pour la requête.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'image' => 'required|string', // ou 'required|image' selon votre besoin
            'status' => 'required|in:inactif,en attente,actif',
        ];
    }
}
