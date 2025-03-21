<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
  // Créer un profil
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'first_name' => 'required|string',
            'status' => 'required|in:inactive,pending,active',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        $admin = Auth::user();
        $imagePath = $request->file('image')->store('profile_images', 'public');

        $profile = Profile::create([
            'name' => $request->name,
            'admin_id' => $admin->id,
            'first_name' => $request->first_name,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        return response()->json($profile, 201);
    }

    // Récupérer les profils actifs
    public function getActiveProfiles()
    {
        $profiles = Profile::where('status', 'active')
                            ->select('id', 'name', 'first_name', 'image')
                            ->get();
        return response()->json($profiles);
    }

    // Modifier ou supprimer un profil
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->update($request->all());
        return response()->json($profile);
    }

    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();
        return response()->json(['message' => 'Profil supprimé avec succès']);
    }
}
