<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService){

    }
    public function register(RegisterRequest $request){
        return $this->userService->register($request->validated());
    }
    public function login(LoginRequest $request){
        return $this->userService->login($request->validated());
    }
    public function logout(){
        return $this->userService->logout();
    }
}
