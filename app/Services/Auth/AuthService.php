<?php

namespace App\Services\Auth;

use App\Exceptions\Auth\InvalidCredentialsException;
use App\Models\User;
use App\Repositories\AuthRepo\AuthRepoInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Sanctum\NewAccessToken;

class AuthService implements AuthServiceInterface
{
    public function __construct(private AuthRepoInterface $authRepo)
    {}

    public function login(array $credentials): NewAccessToken
    {
        $user = $this->authRepo->findUserByCredentials($credentials['email']);

        if (!$user || !Hash::check($credentials['password'], $user->password))
        {
            Log::channel('auth')->warning('Неверный логин или пароль.', [
                'email' => $credentials['email'],
            ]);

            throw new InvalidCredentialsException();
        }

        $tokenName = $credentials['token_name'] ?? 'auth_token';

        return $user->createToken($tokenName);        
    }
}