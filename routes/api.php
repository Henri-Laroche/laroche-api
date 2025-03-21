<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CommentController;
use Laravel\Sanctum\Sanctum;



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});


// Authentification
Route::post('login', [AdminController::class, 'login']); // Pour la connexion
Route::post('register', [AdminController::class, 'register']); // Pour l'enregistrement

Route::middleware('auth:sanctum')->group(function () {
    // Pour gérer les profils
    Route::post('profiles', [ProfileController::class, 'store']);
    Route::get('profiles/active', [ProfileController::class, 'getActiveProfiles']);
    Route::put('profiles/{id}', [ProfileController::class, 'update']);
    Route::delete('profiles/{id}', [ProfileController::class, 'destroy']);

    // Pour ajouter des commentaires
    Route::post('profiles/{id}/comments', [CommentController::class, 'store']);
});
