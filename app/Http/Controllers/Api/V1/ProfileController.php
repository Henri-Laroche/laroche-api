<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Services\Contracts\ProfileServiceInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use OpenApi\Annotations as OA;


class ProfileController extends Controller
{
    use AuthorizesRequests;

    protected ProfileServiceInterface $profileService;

    public function __construct(ProfileServiceInterface $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * @OA\Get(
     *     path="/api/profiles",
     *     tags={"Profiles"},
     *     summary="Récupérer la liste des profils actifs (public, statut visible uniquement pour les admins authentifiés)",
     *     security={{"sanctum":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Liste des profils actifs",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="nom", type="string", example="Laroche"),
     *                 @OA\Property(property="first_name", type="string", example="Henri"),
     *                 @OA\Property(property="image_url", type="string", example="http://localhost:8000/storage/profiles/profile.jpg"),
     *                 @OA\Property(property="admin_id", type="integer", example=1),
     *                 @OA\Property(property="status", type="string", example="actif", description="Visible uniquement pour les administrateurs authentifiés")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Non authentifié (facultatif, uniquement si nécessaire)")
     * )
     */

    // Endpoint public pour récupérer les profils actifs
    public function index(): JsonResponse
    {
        // Récupère uniquement les profils actifs
        $profiles = $this->profileService->getActiveProfiles();

        // Retourne les données formatées via une ressource
        return response()->json(ProfileResource::collection($profiles));
    }

    /**
     * @OA\Post(
     *     path="/api/profiles",
     *     tags={"Profiles"},
     *     summary="Créer un profil (admin uniquement)",
     *     security={{"sanctum":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 required={"nom","first_name","image","status"},
     *                 @OA\Property(property="nom", type="string", example="Laroche"),
     *                 @OA\Property(property="first_name", type="string", example="Henri"),
     *                 @OA\Property(property="image", type="string", format="binary"),
     *                 @OA\Property(property="status", type="string", enum={"inactif","en attente","actif"}, example="actif")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=201, description="Profil créé avec succès"),
     *     @OA\Response(response=422, description="Erreur de validation"),
     *     @OA\Response(response=401, description="Non authentifié"),
     *     @OA\Response(response=403, description="Non autorisé (rôle insuffisant)")
     * )
     */

    // Endpoint protégé pour créer un profil
    public function store(StoreProfileRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            // Stocke l'image dans le dossier "profiles"
            $path = $request->file('image')->store('profiles', 'public');
            $data['image'] = $path;
        }

        $data['admin_id'] = auth()->id();
        $profile = $this->profileService->createProfile($data);

        return response()->json(new ProfileResource($profile), 201);
    }

    /**
     * @OA\Put(
     *     path="/api/profiles/{profile}",
     *     tags={"Profiles"},
     *     summary="Modifier un profil (admin uniquement, tous les admins autorisés)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="profile",
     *         description="ID du profil à modifier",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string", example="Laroche modifié"),
     *             @OA\Property(property="first_name", type="string", example="Henri"),
     *             @OA\Property(property="image", type="string", example="images/nouveau.jpg"),
     *             @OA\Property(property="status", type="string", enum={"inactif", "en attente", "actif"}, example="actif")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Profil modifié avec succès"),
     *     @OA\Response(response=422, description="Erreur de validation"),
     *     @OA\Response(response=404, description="Profil non trouvé"),
     *     @OA\Response(response=401, description="Non authentifié"),
     *     @OA\Response(response=403, description="Non autorisé (rôle insuffisant)")
     * )
     *
     * @throws AuthorizationException
     */

    // Endpoint protégé pour modifier un profil

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        //ici, je laisse le code au cas où si on doit autoriser que l'administrateur qui a créé soit modifié
        //        $this->authorize('update', $profile);
        //        $data = $request->validated();
        //        $updatedProfile = $this->profileService->updateProfile($profile->id, $data);
        //        if (!$updatedProfile) {
        //            return response()->json(['message' => 'Profil introuvable'], 404);
        //        }
        //        return response()->json(new ProfileResource($updatedProfile));


        $this->authorize('update', $profile);

        $updatedProfile = $this->profileService->updateProfile($profile->id, $request->validated());

        return response()->json($updatedProfile);

    }

    /**
     * @OA\Delete(
     *     path="/api/profiles/{profile}",
     *     tags={"Profiles"},
     *     summary="Supprimer un profil (admin uniquement, tous les admins autorisés)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="profile",
     *         description="ID du profil à supprimer",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Profil supprimé avec succès"),
     *     @OA\Response(response=404, description="Profil non trouvé"),
     *     @OA\Response(response=401, description="Non authentifié"),
     *     @OA\Response(response=403, description="Non autorisé (rôle insuffisant)")
     * )
     *
     * @throws AuthorizationException
     */

    // Endpoint protégé pour supprimer un profil

    /**
     * @throws AuthorizationException
     */
    public function destroy(Profile $profile): JsonResponse
    {
        //ici, je laisse le code au cas où si on doit autoriser que l'administrateur qui a créé peux supprimé
        //        $this->authorize('delete', $profile);
        //        $deleted = $this->profileService->deleteProfile($profile->id);
        //        if (!$deleted) {
        //            return response()->json(['message' => 'Profile not found'], 404);
        //        }
        //        return response()->json(['message' => 'Profile deleted successfully']);

        $this->authorize('delete', $profile);

        $this->profileService->deleteProfile($profile->id);

        return response()->json(['message' => 'Profil supprimé avec succès.']);
    }

}
