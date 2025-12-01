<?php

namespace App\Repositories;

use App\Models\Service;

interface ServiceRepoInterface
{
    public function getServices(): \Illuminate\Database\Eloquent\Collection;
    public function findById(int $id): Service;
    public function createService(array $data): Service;
    public function updateService(int $id, array $data): Service;
    public function deleteService(int $id): bool;
}