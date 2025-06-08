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
     *     summary="Recuperar a lista de perfis ativos (público, status visível apenas para administradores autenticados)",
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
     *                 @OA\Property(property="status", type="string", example="actif", description="Visível apenas para administradores autenticados")
     *             )
     *         )
     *     ),
     *     @OA\Response(response=401, description="Não autenticado (opcional, somente se necessário)")
     * )
     */

        // Endpoint público para recuperar os perfis ativos
    public function index(): JsonResponse
    {
        // Recupera apenas os perfis ativos
        $profiles = $this->profileService->getActiveProfiles();

        // Retorna os dados formatados por meio de um recurso
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

    // Endpoint protegido para criar um perfil
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
     *     summary="Editar um perfil (somente administradores, todos os administradores têm permissão)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="profile",
     *         description="ID do perfil a ser editado",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="nom", type="string", example="Laroche modificqdo"),
     *             @OA\Property(property="first_name", type="string", example="Henri"),
     *             @OA\Property(property="image", type="string", example="images/novo.jpg"),
     *             @OA\Property(property="status", type="string", enum={"inactif", "en attente", "actif"}, example="actif")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Profil modificqdo com sucesso"),
     *     @OA\Response(response=422, description="Error de validação"),
     *     @OA\Response(response=404, description="Perfil não encontrado"),
     *     @OA\Response(response=401, description="Não autenticado"),
     *     @OA\Response(response=403, description="Não autorizado (permissão insuficiente)")
     * )
     *
     * @throws AuthorizationException
     */

    // Endpoint protegido para editar um perfil

    /**
     * @throws AuthorizationException
     */
    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        //Aqui, deixo o código caso seja necessário permitir que apenas o administrador que criou possa editar
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
     *     tags={"Perfis"},
     *     summary="Excluir um perfil (somente administradores, todos os administradores têm permissão)",
     *     security={{"sanctum":{}}},
     *     @OA\Parameter(
     *         name="profile",
     *         description="ID do perfil a ser excluído",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(response=200, description="Perfil excluído com sucesso"),
     *     @OA\Response(response=404, description="Perfil não encontrado"),
     *     @OA\Response(response=401, description="Não autenticado"),
     *     @OA\Response(response=403, description="Não autorizado (permissão insuficiente)")
     * )
     *
     * @throws AuthorizationException
     */

    // Endpoint protegido para excluir um perfil

    /**
     * @throws AuthorizationException
     */
    public function destroy(Profile $profile): JsonResponse
    {
        // Aqui, deixo o código caso seja necessário permitir que apenas o administrador que criou possa excluir
        //        $this->authorize('delete', $profile);
        //        $deleted = $this->profileService->deleteProfile($profile->id);
        //        if (!$deleted) {
        //            return response()->json(['message' => 'Profile not found'], 404);
        //        }
        //        return response()->json(['message' => 'Profile deleted successfully']);

        $this->authorize('delete', $profile);

        $this->profileService->deleteProfile($profile->id);

        return response()->json(['message' => 'Perfil excluído com sucesso.']);
    }

}
