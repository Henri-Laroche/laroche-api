<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // L'accès est maintenant géré via la CommentPolicy
        return true;
    }

    public function rules(): array
    {
        return [
            'profile_id' => [
                'required',
                'exists:profiles,id',
            ],
            'content' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'profile_id.required' => 'Le profil est requis.',
            'profile_id.exists'   => 'Ce profil n\'existe pas.',
            'content.required'    => 'Le contenu du commentaire est requis.',
        ];
    }
}
