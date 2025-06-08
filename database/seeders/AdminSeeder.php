<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Criação de um superadmin com credenciais conhecidas
        Admin::factory()->create([
            'name' => 'Super Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Criação de  varios administradores aleatorios
        Admin::factory()->count(5)->create();
    }
}
