<?php

namespace App\Services\Service;

use App\Dto\Service\CreateServiceRequestDto;
use App\Models\Service;
use Illuminate\Support\Collection;

interface ServiceServiceInterface
{
    public function getServices(): Collection;

    public function getServiceById(int $id): Service;

    public function createService(CreateServiceRequestDto $createServiceRequestDto): Service;

    public function updateService(Service $service, array $data): Service;

    public function deleteService(Service $service): bool;
}