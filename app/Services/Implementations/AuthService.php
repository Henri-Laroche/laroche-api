<?php

namespace App\Services\Implementations;

use App\Models\Admin;
use App\Services\Contracts\AuthServiceInterface;
use Illuminate\Support\Facades\Hash;

class AuthService implements AuthServiceInterface
{
    /**
     * Register a new admin.
     *
     * @param array $data
     * @return Admin
     */
    public function register(array $data): Admin
    {
        $data['password'] = Hash::make($data['password']);
        return Admin::create($data);
    }

    /**
     * Authenticate an admin and generate an API token.
     *
     * @param array $credentials
     * @return string|false
     */
    public function login(array $credentials): false|string
    {
        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return false;
        }
        // Génère et retourne un token via Sanctum
        return $admin->createToken('apiToken')->plainTextToken;
    }

}
