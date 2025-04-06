<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;


class AuthService
{
    protected $userModel;

    public function __construct($userModel)
    {
        $this->userModel = $userModel;
    }
    public function login(array $credentials)
    {
        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Incorrect Credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken(env('TOKEN_NAME'))->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    public function register(array $data)
    {
        $user = $this->userModel->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        if (isset($data['role']) && Auth::check() && Auth::user()->hasRole('admin')) {
            $user->assignRole($data['role']);
        } else {
            $user->assignRole('coach');
        }

        $token = $user->createToken('Personal Access Token')->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
