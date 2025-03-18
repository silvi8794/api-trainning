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