<?php


namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function admin_can_register()
    {
        $data = [
            'name' => 'Henri Laroche',
            'email' => 'admin@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->postJson('/api/register', $data);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'token'])
            ->assertJson(['message' => 'Connexion réussie']);

        $this->assertDatabaseHas('admins', ['email' => 'admin@example.com']);
    }

    #[Test]
    public function admin_can_login_with_valid_credentials()
    {
        $admin = Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $credentials = [
            'email' => 'admin@example.com',
            'password' => 'password123',
        ];

        $response = $this->postJson('/api/login', $credentials);

        $response->assertStatus(200)
            ->assertJsonStructure(['message', 'token'])
            ->assertJson(['message' => 'Connexion réussie']);
    }

    #[Test]
    public function admin_cannot_login_with_invalid_credentials()
    {
        Admin::factory()->create([
            'email' => 'admin@example.com',
            'password' => bcrypt('password123'),
        ]);

        $invalidCredentials = [
            'email' => 'admin@example.com',
            'password' => 'wrongpassword',
        ];

        $response = $this->postJson('/api/login', $invalidCredentials);

        $response->assertStatus(401)
            ->assertJson(['message' => 'Identifiants invalides']);
    }
}
