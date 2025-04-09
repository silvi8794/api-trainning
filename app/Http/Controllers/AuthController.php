<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use App\Http\Services\AuthService;
use Illuminate\Support\Facades\Log;
use Exception;


class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
/**
* @OA\Post(
*     path="/api/register",
*     summary="Registrar un nuevo usuario",
*     tags={"Autenticación"},
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"name","email","password"},
*             @OA\Property(property="name", type="string", example="Juan Pérez"),
*             @OA\Property(property="email", type="string", format="email", example="juan@example.com"),
*             @OA\Property(property="password", type="string", format="password", example="secret123")
*         )
*     ),
*     @OA\Response(
*         response=201,
*         description="Usuario registrado con éxito",
*         @OA\JsonContent(
*             @OA\Property(property="user", type="object"),
*             @OA\Property(property="token", type="string", example="jwt.token.aquí")
*         )
*     ),
*     @OA\Response(
*         response=400,
*         description="Datos inválidos"
*     ),
*     @OA\Response(
*         response=500,
*         description="Error interno del servidor"
*     )
* )
*/
    public function register(AuthRequest $request)
    {
        try {
            $data = $this->authService->register($request->validated());

            Log::info('Datos registrados:', $request->only(['name', 'email']));

            return response()->json($data, 201);
        } catch (Exception $e) {
            Log::error('Error al registrar usuario: ' . $e->getMessage(), [
                'exception' => $e
            ]);
        }
    }

/**
* @OA\Post(
*     path="/api/login",
*     summary="Iniciar sesión",
*     tags={"Autenticación"},
*     @OA\RequestBody(
*         required=true,
*         @OA\JsonContent(
*             required={"email","password"},
*             @OA\Property(property="email", type="string", format="email", example="juan@example.com"),
*             @OA\Property(property="password", type="string", format="password", example="secret123")
*         )
*     ),
*     @OA\Response(
*         response=200,
*         description="Inicio de sesión exitoso",
*         @OA\JsonContent(
*             @OA\Property(property="token", type="string", example="jwt.token.aquí")
*         )
*     ),
*     @OA\Response(
*         response=401,
*         description="Credenciales inválidas"
*     )
* )
*/
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $token = $this->authService->login($credentials);

        if ($token) {
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
