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

    public function register(UserRegisterRequest $request)
    {
        return $this->userRepository->register($request);
    }

    public function login(Request $request)
    {
        return $this->userRepository->login($request);
    }

    public function logout()
    {
        return $this->userRepository->logout();
    }

    public function refresh()
    {
        return $this->userRepository->refresh();
    }

    public function profile()
    {
        return $this->userRepository->profile();
    }
}
