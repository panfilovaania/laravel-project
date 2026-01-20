<?php

namespace App\Repositories\AuthRepo;

use App\Models\User;

class EloquentAuthRepo implements AuthRepoInterface
{
    public function findUserByCredentials(string $email): User
    {
        $user = User::where("email", $email)
                ->first();
                
        return $user;
    }
}