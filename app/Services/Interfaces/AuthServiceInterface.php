<?php
namespace App\Services\Interfaces;

interface AuthServiceInterface
{
    public function register(array $data): array;
    public function login(array $credentials): array;
}
