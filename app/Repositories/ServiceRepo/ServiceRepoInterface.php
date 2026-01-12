<?php

namespace App\Repositories\ServiceRepo;

use App\Models\Service;
use Illuminate\Support\Collection;

interface ServiceRepoInterface
{
    public function getServices(): Collection;
    public function findById(int $id): Service;
    public function createService(array $data): Service;
    public function updateService(Service $service, array $data): Service;
    public function deleteService(Service $service): bool;
}