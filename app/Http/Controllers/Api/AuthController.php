<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Http\Services\User\IUserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(RegisterRequest $request)
    {
        $userData = $request->validated();

        $this->userService->store($userData);

        return response()->json(['message' => 'You are registered successfully'], 200);
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt($request->validated())) {
            return response()->json(['message' => 'You are logged in successfully'], 200);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
