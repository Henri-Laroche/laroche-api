<?php

namespace App\Repositories;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    public function createAdmin(array $data): Admin
    {
        $data['password'] = Hash::make($data['password']);
        return Admin::create($data);
    }

    public function getAdminByEmail(string $email): ?Admin
    {
        return Admin::where('email', $email)->first();
    }
}