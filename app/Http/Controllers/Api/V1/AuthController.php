<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Services\Implementations\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"Auth"},
     *     summary="Cadastro de um novo administrador",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="Super Admin"),
     *             @OA\Property(property="email", type="string", format="email", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=201, description="Conta criada com sucesso"),
     *     @OA\Response(response=422, description="Erro de validação")
     * )
     */
    public function register(Request $request): JsonResponse
    {
        // Validar a requisição, criar o administrador e retornar um token
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $admin = $this->authService->register($data);

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'token'   => $admin->createToken('apiToken')->plainTextToken
        ], 201);
    }

    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"Auth"},
     *     summary="Login de um administrador",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@example.com"),
     *             @OA\Property(property="password", type="string", format="password", example="password123")
     *         )
     *     ),
     *     @OA\Response(response=200, description="Conectado com sucesso"),
     *     @OA\Response(response=401, description="Credenciais inválidas")
     * )
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $token = $this->authService->login($credentials);

        if (!$token) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        return response()->json([
            'message' => 'Conectado com sucesso',
            'token'   => $token
        ]);
    }

}
