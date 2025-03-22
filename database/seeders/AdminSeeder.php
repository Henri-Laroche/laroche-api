<?php
namespace
 Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        Admin::factory(10)->create(); // Crée 10 administrateurs
    }
}
