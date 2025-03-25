<?php


namespace Tests\Unit;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\Profile;
use App\Policies\CommentPolicy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentPolicyTest extends TestCase
{
    use RefreshDatabase;

    protected CommentPolicy $policy;

    protected function setUp(): void
    {
        parent::setUp();
        $this->policy = new CommentPolicy();
    }

    public function test_admin_can_comment_if_not_already_commented()
    {
        $admin = Admin::factory()->create();
        $profile = Profile::factory()->create();

        $this->assertTrue($this->policy->create($admin, $profile));
    }

    public function test_admin_cannot_comment_twice_on_same_profile()
    {
        $admin = Admin::factory()->create();
        $profile = Profile::factory()->create();

        Comment::factory()->create([
            'admin_id' => $admin->id,
            'profile_id' => $profile->id,
        ]);

        $this->assertFalse($this->policy->create($admin, $profile));
    }
}
