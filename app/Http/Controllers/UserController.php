<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRegisterRequest;
use App\Repository\UserRepository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $userRepository;
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth')->except('register','login');
    }

    public function getUser(){
        return $this->userRepository->GetUser();
    }

    public function register(Request $request)
    {
        return $this->userRepository->Register($request);
    }

    public function login(Request $request)
    {
        return $this->userRepository->Login($request);
    }

    public function logout()
    {
        return $this->userRepository->Logout();
    }

    public function refresh()
    {
        return $this->userRepository->Refresh();
    }

    public function profile()
    {
        return $this->userRepository->Profile();
    }
}
