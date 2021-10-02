<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserRegisterRequest;
use App\Repository\UserRepository\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request)
    {
        return $this->userRepository->register($request);
    }

    public function login(Request $request)
    {
        return $this->userRepository->login($request);
    }
}
