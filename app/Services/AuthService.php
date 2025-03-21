<?php

namespace App\Services;

use App\Repositories\Interfaces\AdminRepositoryInterface;
use App\Services\Interfaces\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    protected $adminRepo;

    public function __construct(AdminRepositoryInterface $adminRepo)
    {
        $this->adminRepo = $adminRepo;
    }

    public function register(array $data): array
    {
        $admin = $this->adminRepo->createAdmin($data);
        return [
            'token' => $admin->createToken('auth_token')->plainTextToken,
            'admin' => $admin
        ];
    }

    public function login(array $credentials): array
    {
        if (!Auth::attempt($credentials)) {
            abort(401, 'Invalid credentials');
        }

        $admin = $this->adminRepo->getAdminByEmail($credentials['email']);
        return [
            'token' => $admin->createToken('auth_token')->plainTextToken,
            'admin' => $admin
        ];
    }
}