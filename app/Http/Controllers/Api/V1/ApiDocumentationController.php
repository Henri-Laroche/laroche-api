<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

/**
 * @OA\Info(
 *     title="Laroche API Laravel 12",
 *     version="1.0.0",
 *     description="Documentação completa da API Laravel com Sanctum, Swagger e uma arquitetura limpa (SOLID)."
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
