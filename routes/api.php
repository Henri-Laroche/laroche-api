<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
