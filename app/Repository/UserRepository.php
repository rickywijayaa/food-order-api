<?php

namespace App\Repository\UserRepository;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserRepository
{
    public function GetUser(){
        try
        {
            $data = User::get(['name','email']);
            return response()->json([
                "message" => "Successfully Get Users",
                "data" => $data
            ],200);
        }
        catch(Exception $ex)
        {
            $this->ReturnErrorMessage();
        }
    }

    public function Register($request)
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
            $this->ReturnErrorMessage();
        }
    }

    public function Login($request)
    {
        try{
            $credentials = $request->only(['email', 'password']);
            if (!$token = Auth::attempt($credentials)) {
                return response()->json(['message' => 'Email / Password salah'], 401);
            }
            return $this->respondWithToken($token);
        }catch(Exception $ex){
            $this->ReturnErrorMessage();
        }
    }

    public function Profile()
    {
        return response()->json(Auth::user());
    }

    public function Logout()
    {
        Auth::guard()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function Refresh()
    {
        return $this->RespondWithToken(Auth::guard()->refresh());
    }

    private function RespondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    private function ReturnErrorMessage(){
        return response()->json([
            'message' => 'Something wrong'
        ],404);
    }
}