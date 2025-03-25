<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Laroche API Laravel 12",
 *     version="1.0.0",
 *     description="Documentation complète de l'API Laravel avec Sanctum, Swagger et une architecture propre (SOLID)."
 * )
 *
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     description="Token Sanctum (Bearer {token})",
 *     name="Authorization",
 *     in="header",
 *     securityScheme="sanctum"
 * )
 */
class ApiDocumentationController extends Controller
{
    //
}
