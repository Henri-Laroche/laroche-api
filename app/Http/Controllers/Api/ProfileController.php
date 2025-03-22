<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Créer un profil
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'last_name' => 'required|string',
            'first_name' => 'required|string',
            'status' => 'required|in:inactive,pending,active',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $admin = Auth::user();
        $imagePath = $request->file('image')->store('profile_images', 'public');

        $profile = Profile::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'admin_id' => $admin->id,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return response()->json($profile, 201);
    }

    // Récupérer les profils actifs
    public function getActiveProfiles(): JsonResponse
    {
        $profiles = Profile::where('status', 'active')
            ->select('id', 'last_name', 'first_name', 'image')
            ->get();
        return response()->json($profiles);
    }

    // Modifier ou supprimer un profil
    public function update(Request $request, $id): JsonResponse
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());
        return response()->json($profile);
    }

    public function destroy($id): JsonResponse
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return response()->json(['message' => 'Profil supprimé avec succès']);
    }
}
