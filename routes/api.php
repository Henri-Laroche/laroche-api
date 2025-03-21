<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\AuthController;
use Laravel\Sanctum\Sanctum;



//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});


// Authentification
Route::prefix('auth')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::middleware('auth:sanctum')->group(function () {
    // Pour gérer les profils
    Route::post('profiles', [ProfileController::class, 'store']);
    Route::get('profiles/active', [ProfileController::class, 'getActiveProfiles']);
    Route::put('profiles/{id}', [ProfileController::class, 'update']);
    Route::delete('profiles/{id}', [ProfileController::class, 'destroy']);

    // Pour ajouter des commentaires
    Route::post('profiles/{id}/comments', [CommentController::class, 'store']);
});





