<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Repositories\AuthRepo\AuthRepoInterface;

class AuthService implements AuthServiceInterface
{
    public function __construct(private AuthRepoInterface $authRepo)
    {}

    public function login(array $credentials)
    {
        $user = $this->authRepo->findUserByCredentials($credentials);

        if ($user != null)
        {
            $tokenName = $credentials['token_name'] ?? 'auth_token';
            $token = $user->createToken($tokenName);

            return $token;
        }
        return null;
    }
}