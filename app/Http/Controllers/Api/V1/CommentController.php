<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\Profile;
use App\Services\Contracts\CommentServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    use AuthorizesRequests;

    protected CommentServiceInterface $commentService;

    public function __construct(CommentServiceInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    /**
     * @OA\Post(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     summary="Adicionar um comentário em um perfil (somente administradores, apenas um comentário por perfil)",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"profile_id","content"},
     *             @OA\Property(property="profile_id", type="integer", example=1),
     *             @OA\Property(property="content", type="string", example="Ótimo perfil!")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Comentário adicionado com sucesso"),
     *     @OA\Response(response=403, description="Ação não permitida: este perfil já possui um comentário."),
     *     @OA\Response(response=422, description="Alguns campos estão incorretos ou ausentes"),
     *     @OA\Response(response=401, description="Usuário não autenticado.")
     * )
     *
     * @throws AuthorizationException
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $admin = auth()->user();
        $profile = Profile::findOrFail($request->validated('profile_id'));

        // Autorisation via CommentPolicy
        $this->authorize('create', [Comment::class, $profile]);

        $comment = $this->commentService->createComment([
            'admin_id' => $admin->id,
            'profile_id' => $profile->id,
            'content' => $request->validated('content'),
        ]);

        return response()->json($comment, 201);
    }
}
