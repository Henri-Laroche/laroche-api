<?php

namespace App\Services\Contracts;

use App\Models\Admin;

interface AuthServiceInterface
{
    /**
     * Register a new admin.
     *
     * @param array $data
     * @return Admin
     */
    public function register(array $data): Admin;

    /**
     * Authenticate an admin and generate an API token.
     *
     * @param array $credentials
     * @return string|false  Returns the token string if authentication is successful, false otherwise.
     */
    public function login(array $credentials): false|string;
}
