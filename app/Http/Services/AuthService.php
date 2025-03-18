<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthService
{
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
         $user = User::create([
             'name' => $data['name'],
             'email' => $data['email'],
             'password' => Hash::make($data['password']),
         ]);
 
         $token = $user->createToken('Personal Access Token')->accessToken;
 
         return [
             'user' => $user,
             'token' => $token,
         ];
     }
}