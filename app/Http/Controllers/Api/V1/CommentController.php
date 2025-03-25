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
use OpenApi\Annotations as OA;


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


    /**
     * @OA\Post(
     *     path="/api/comments",
     *     tags={"Comments"},
     *     summary="Ajouter un commentaire sur un profil (admin uniquement, un seul commentaire par profil)",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"profile_id","content"},
     *             @OA\Property(property="profile_id", type="integer", example=1),
     *             @OA\Property(property="content", type="string", example="Très bon profil !")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Commentaire ajouté avec succès"),
     *     @OA\Response(response=403, description="Action non autorisée (déjà commenté)"),
     *     @OA\Response(response=422, description="Erreur de validation des données"),
     *     @OA\Response(response=401, description="Non authentifié")
     * )
     *
     * @throws AuthorizationException
     */

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
