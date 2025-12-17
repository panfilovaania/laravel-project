<?php

namespace App\Services\Service;

use App\Dto\Service\CreateServiceRequestDto;
use App\Dto\Service\CreateServiceResponseDto;
use App\Dto\Service\ServiceDto;
use App\Dto\Service\UpdateServiceResponseDto;
use Illuminate\Support\Collection;

interface ServiceServiceInterface
{
    public function getServices(): Collection;

    public function getServiceById(int $id): ServiceDto;

    public function createService(CreateServiceRequestDto $createServiceRequestDto): CreateServiceResponseDto;

    public function updateService(int $id, array $data): UpdateServiceResponseDto;

    public function deleteService(int $id): bool;
}