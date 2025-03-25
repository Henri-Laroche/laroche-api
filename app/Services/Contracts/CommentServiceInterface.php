<?php

namespace App\Services\Contracts;

use App\Models\Comment;

interface CommentServiceInterface
{
    public function createComment(array $data): Comment;
}
