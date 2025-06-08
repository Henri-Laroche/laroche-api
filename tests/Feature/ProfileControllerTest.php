<?php

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\Admin;
use App\Models\Profile;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function can_create_profile()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin, ['*']);

        $data = [
            'nom'        => 'Laroche',
            'first_name' => 'Henri',
            'image'      => 'images/sample.jpg',
            'status'     => 'ativo'
        ];

        $response = $this->postJson('/api/profiles', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['nom' => 'Laroche']);

        $this->assertDatabaseHas('profiles', [
            'nom'      => 'Laroche',
            'admin_id' => $admin->id
        ]);
    }

    #[Test]
    public function test_any_admin_can_update_any_profile()
    {
        $admin1 = Admin::factory()->create();
        $admin2 = Admin::factory()->create();
        Sanctum::actingAs($admin1);

        $profile = Profile::factory()->create(['admin_id' => $admin2->id]);

        $data = ['nom' => 'Atualizado por outro administrador'];

        $response = $this->putJson("/api/profiles/{$profile->id}", $data);

        $response->assertStatus(200)
            ->assertJsonFragment(['nom' => 'Atualizado por outro administrador']);

        $this->assertDatabaseHas('profiles', [
            'id'  => $profile->id,
            'nom' => 'Atualizado por outro administrador'
        ]);
    }

    #[Test]
    public function test_any_admin_can_delete_any_profile()
    {
        $admin1 = Admin::factory()->create();
        $admin2 = Admin::factory()->create();
        Sanctum::actingAs($admin1);

        $profile = Profile::factory()->create(['admin_id' => $admin2->id]);

        $response = $this->deleteJson("/api/profiles/{$profile->id}");

        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Perfil excluído com sucesso.']);

        $this->assertDatabaseMissing('profiles', [
            'id' => $profile->id,
        ]);
    }

    #[Test]
    public function test_public_cannot_see_status_field()
    {
        $profile = Profile::factory()->create(['status' => 'ativo']);

        $response = $this->getJson('/api/profiles');

        $response->assertStatus(200)
            ->assertJsonMissing(['status' => 'ativo'])
            ->assertJsonFragment(['nom' => $profile->nom]);
    }

    #[Test]
    public function test_authenticated_admin_can_see_status_field()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin, ['*']);

        $profile = Profile::factory()->create(['status' => 'ativo']);

        $response = $this->getJson('/api/profiles');

        $response->assertStatus(200)
            ->assertJsonFragment([
                'status' => 'ativo',
                'nom'    => $profile->nom
            ]);
    }
}
