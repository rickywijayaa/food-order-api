<?php

namespace App\Repository\UserRepository;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserRepository
{
    public function register($request)
    {
        try{
            $data = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => Hash::make($request->password),
                "isAdmin" => 0
            ]);

            return response()->json([
                "message" => "Successfully register",
                "data" => $data
            ],201);
        }catch(Exception $ex){
            $this->returnErrorMessage();
        }
    }

    public function login($request)
    {
        try{
            $credentials = $request->only(['email', 'password']);
            if (!$token = Auth::attempt($credentials)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
            return $this->respondWithToken($token);
        }catch(Exception $ex){
            $this->returnErrorMessage();
        }
    }

    public function profile()
    {
        return response()->json(Auth::user());
    }

    public function logout()
    {
        Auth::guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(Auth::guard()->refresh());
    }

    private function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    private function returnErrorMessage(){
        return response()->json([
            'message' => 'Something wrong'
        ],404);
    }
}