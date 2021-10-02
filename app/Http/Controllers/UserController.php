<?php

namespace App\Http\Controllers;
use App\Repository\UserRepository\UserRepository as UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
}
