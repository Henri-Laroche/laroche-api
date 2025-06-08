<?php

namespace App\Services\Contracts;

use App\Models\Admin;

interface AuthServiceInterface
{
    /**
     *Registrar um novo administrador.
     *
     * @param array $data
     * @return Admin
     */
    public function register(array $data): Admin;

    /**
     * Autenticar um administrador e gerar um token de API.
     *
     * @param array $credentials
     * @return string|false  Retorna a string do token se a autenticação for bem-sucedida; caso contrário, retorna false.
     */
    public function login(array $credentials): false|string;
}
