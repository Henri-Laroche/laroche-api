<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\ProfileController;
use Illuminate\Support\Facades\Route;




// Rotas de autenticação
Route::post('register', [AuthController::class, 'register'])
    ->name('auth.register');
Route::post('login', [AuthController::class, 'login'])
    ->name('auth.login');

// Endpoints protegidos por auth:sanctum e middleware 'admin'
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    // Criação de perfil
    Route::post('profiles', [ProfileController::class, 'store'])
        ->name('profiles.store');

    // Alteração de perfil
    Route::put('profiles/{profile}', [ProfileController::class, 'update'])
        ->name('profiles.update');

    // Exclusão de perfil
    Route::delete('profiles/{profile}', [ProfileController::class, 'destroy'])
        ->name('profiles.destroy');

    // Adicionar comentário em perfil
    Route::post('comments', [CommentController::class, 'store'])
        ->name('comments.store');
});

// Endpoint público para listar perfis ativos
Route::get('profiles', [ProfileController::class, 'index'])
    ->name('profiles.index');
