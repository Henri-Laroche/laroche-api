<?php

namespace App\Services\Implementations;

use App\Models\Comment;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Validation\ValidationException;

class CommentService implements CommentServiceInterface
{
    /**
     * @throws ValidationException
     */
    public function createComment(array $data): Comment
    {
        $exists = Comment::where('profile_id', $data['profile_id'])
            ->where('admin_id', $data['admin_id'])
            ->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'profile_id' => 'Vous avez déjà commenté ce profil.'
            ]);
        }

        return Comment::create($data);
    }
}
