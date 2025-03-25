<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Support\Facades\Route;





Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);


// Endpoints protégés par auth : sanctum et middleware 'admin'
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::post('profiles', [ProfileController::class, 'store']);
    // Modification et suppression d'un profil
    Route::put('profiles/{profile}', [ProfileController::class, 'update']);
    Route::delete('profiles/{profile}', [ProfileController::class, 'destroy']);

    // Ajout d'un commentaire sur un profil
    Route::post('comments', [CommentController::class, 'store']);
});

// Endpoint public pour récupérer les profils actifs
Route::get('profiles', [ProfileController::class, 'index']);
