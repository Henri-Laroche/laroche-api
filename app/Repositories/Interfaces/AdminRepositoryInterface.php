<?php

namespace App\Repositories\Interfaces;

use App\Models\Admin;

interface AdminRepositoryInterface
{
    public function createAdmin(array $data): Admin;
    public function getAdminByEmail(string $email): ?Admin;
}