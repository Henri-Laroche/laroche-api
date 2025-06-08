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
    public function admin_pode_registrar()
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
            ->assertJson(['message' => 'Login realizado com sucesso']);

        $this->assertDatabaseHas('admins', ['email' => 'admin@example.com']);
    }

    #[Test]
    public function admin_pode_logar_com_credenciais_validas()
    {
        // Cria um admin no banco para testar o login
        Admin::factory()->create([
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
            ->assertJson(['message' => 'Conectado com sucesso']);
    }

    #[Test]
    public function admin_nao_pode_logar_com_credenciais_invalidas()
    {
        // Garante que exista um admin para a tentativa de login
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
            ->assertJson(['message' => 'Credenciais inválidas']);
    }
}
