<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Support\Facades\Log;

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

        Log::info("Пользователь {$validated['email']} вошел в систему");

        return response()->json(['token' => $token->plainTextToken]);
    }
}
