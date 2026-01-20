<?php

namespace App\Repositories\AuthRepo;

use App\Models\User;

class EloquentAuthRepo implements AuthRepoInterface
{
    public function findUserByCredentials(array $credentials): User
    {
        $user = User::where("email", $credentials['email'])
                ->where("password", $credentials['password'])
                ->first();
                
        return $user;
    }
}