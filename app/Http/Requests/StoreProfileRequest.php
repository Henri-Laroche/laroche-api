<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Retorne true para autorizar todos os usuários autenticados (ou aplique sua própria lógica)
        return true;
    }

    /**
     * Define as regras de validação para a requisição.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'image' => 'required|string', // ou 'required|image' conforme sua necessidade
            'status' => 'required|in:inativo,pendente,ativo',
        ];

    }
}
