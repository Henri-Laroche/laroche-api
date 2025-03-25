<?php


namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Admin;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_profile_creation()
    {
        $admin = Admin::factory()->create();
        $data = [
            'admin_id' => $admin->id,
            'nom' => 'Doe',
            'first_name' => 'John',
            'image' => 'images/sample.jpg',
            'status' => 'actif'
        ];

        $profile = Profile::create($data);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'nom' => 'Doe'
        ]);
    }

    public function test_profile_update()
    {
        $admin = Admin::factory()->create();
        $profile = Profile::factory()->create(['admin_id' => $admin->id, 'nom' => 'OldName']);
        $updateData = ['nom' => 'NewName'];

        $profile->update($updateData);

        $this->assertDatabaseHas('profiles', [
            'id' => $profile->id,
            'nom' => 'NewName'
        ]);
    }
}

