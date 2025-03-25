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

    public function test_admin_can_add_comment_to_profile()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);

        $profile = Profile::factory()->create();

        $data = [
            'profile_id' => $profile->id,
            'content'    => 'Très bon profil, travail remarquable !'
        ];

        $response = $this->postJson('/api/comments', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['content' => 'Très bon profil, travail remarquable !']);

        $this->assertDatabaseHas('comments', [
            'profile_id' => $profile->id,
            'admin_id'   => $admin->id,
            'content'    => 'Très bon profil, travail remarquable !',
        ]);
    }
    public function test_admin_cannot_create_multiple_comments_on_same_profile()
    {
        $admin = Admin::factory()->create(['role' => 'admin']);
        Sanctum::actingAs($admin);

        $profile = Profile::factory()->create();

        Comment::factory()->create([
            'admin_id'   => $admin->id,
            'profile_id' => $profile->id,
            'content'    => 'Premier commentaire'
        ]);

        $this->assertFalse($admin->can('create', [Comment::class, $profile]));
    }

}
