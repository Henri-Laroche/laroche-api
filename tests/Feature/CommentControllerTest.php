<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Profile;
use App\Models\Comment;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_pode_adicionar_comentario_ao_perfil()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);

        $profile = Profile::factory()->create();

        $data = [
            'profile_id' => $profile->id,
            'content'    => 'Ótimo perfil, trabalho notável!'
        ];

        $response = $this->postJson('/api/comments', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['content' => 'Ótimo perfil, trabalho notável!']);

        $this->assertDatabaseHas('comments', [
            'profile_id' => $profile->id,
            'admin_id'   => $admin->id,
            'content'    => 'Ótimo perfil, trabalho notável!',
        ]);
    }

    public function test_admin_nao_pode_criar_multiplos_comentarios_no_mesmo_perfil()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);

        $profile = Profile::factory()->create();

        Comment::factory()->create([
            'admin_id'   => $admin->id,
            'profile_id' => $profile->id,
            'content'    => 'Primeiro comentário'
        ]);

        $this->assertFalse($admin->can('create', [Comment::class, $profile]));
    }
}
