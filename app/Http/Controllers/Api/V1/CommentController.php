<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Profile;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;


/**
 * @method authorize(string $string, array $array)
 */
class CommentController extends Controller
{
    use AuthorizesRequests;

    protected CommentServiceInterface $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    // Endpoint protégé pour ajouter un commentaire sur un profil.
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $data = $request->validated();
        $profile = Profile::findOrFail($data['profile_id']);

        // Maintenant, cette méthode fonctionnera correctement.
        $this->authorize('create', [Comment::class, $profile]);

        $data['admin_id'] = auth()->id();

        $comment = Comment::create($data);

        return response()->json($comment, 201);
    }
}
