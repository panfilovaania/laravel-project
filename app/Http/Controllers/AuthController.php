<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $token = $this->authService->login($validated);

        if (!$token) {
            return response()->json([
                'message' => 'Пользователь не найден.'
            ], 401);
        }
        
        return response()->json(['token' => $token->plainTextToken]);
    }
}
