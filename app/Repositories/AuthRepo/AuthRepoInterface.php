<?php

namespace App\Repositories\AuthRepo;

use App\Models\User;
use Illuminate\Support\Collection;

interface AuthRepoInterface
{
    public function findUserByCredentials(array $credentials): User;
}