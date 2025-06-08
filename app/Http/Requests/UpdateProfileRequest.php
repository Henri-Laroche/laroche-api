<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer esta requisição.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Você pode adicionar uma lógica de autorização aqui.
        return true;
    }

    /**
     * Retorna as regras de validação para a atualização de um perfil.
     *
     * Usar "sometimes|required" permite uma atualização parcial.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'nom' => 'sometimes|required|string|max:255',
            'first_name' => 'sometimes|required|string|max:255',
            'image' => 'sometimes|required|string', // ou 'sometimes|required|image' se você estiver lidando com um arquivo
            'status' => 'sometimes|required|in:inativo,pendente,ativo',
        ];
    }
}
