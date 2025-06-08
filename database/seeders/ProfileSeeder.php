<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Profile;
use App\Models\Admin;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Para cada admin existente, criar 3 perfis
        $admins = Admin::all();

        foreach ($admins as $admin) {
            Profile::factory()->count(5)->create([
                'admin_id' => $admin->id,
            ]);
        }
    }
}
