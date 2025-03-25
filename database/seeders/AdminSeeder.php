<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Création d'un super admin avec des identifiants connus
        Admin::factory()->create([
            'name' => 'Super Admin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        // Création d'autres admins aléatoires
        Admin::factory()->count(5)->create();
    }
}
