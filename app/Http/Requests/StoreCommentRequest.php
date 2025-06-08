<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        // O acesso agora é gerenciado via CommentPolicy
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
            'profile_id.required' => 'O perfil é obrigatório.',
            'profile_id.exists'   => 'Este perfil não existe.',
            'content.required'    => 'O conteúdo do comentário é obrigatório.',
        ];
    }
}
