<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Models\Profile;
use App\Services\Contracts\ProfileServiceInterface;
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

    // Endpoint public pour récupérer les profils actifs
    public function index(): JsonResponse
    {
        // Récupère uniquement les profils actifs
        $profiles = $this->profileService->getActiveProfiles();

        // Retourne les données formatées via une ressource
        return response()->json(ProfileResource::collection($profiles));
    }

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


    // Endpoint protégé pour modifier un profil
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


        $this->authorize('update', $profile); // 👈 Autorise toujours !

        $updatedProfile = $this->profileService->updateProfile($profile->id, $request->validated());

        return response()->json($updatedProfile);

    }


    // Endpoint protégé pour supprimer un profil
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
