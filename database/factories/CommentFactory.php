<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Admin;
use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->sentence(),
            'admin_id' => Admin::factory(),
            'profile_id' => Profile::factory(),
        ];
    }
}
