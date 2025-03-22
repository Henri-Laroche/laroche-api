<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Support\Facades\Validator;

class AdminRepository implements AdminRepositoryInterface
{
    /**
     * @throws \Exception
     */
    public function createAdmin(array $data): Admin
    {
        // Validation des données avant la création
        $validator = Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:8',  // Exemple de validation du mot de passe
        ]);

        if ($validator->fails()) {
            throw new \Exception('Validation failed');
        }

        $data['password'] = Hash::make($data['password']);
        return Admin::create($data);
    }

    public function getAdminByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}
