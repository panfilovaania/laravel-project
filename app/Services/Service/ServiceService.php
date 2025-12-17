<?php

namespace App\Services\Service;

use App\Dto\Service\CreateServiceRequestDto;
use App\Dto\Service\CreateServiceResponseDto;
use App\Dto\Service\ServiceDto;
use App\Dto\Service\UpdateServiceResponseDto;
use App\Repositories\ServiceRepo\ServiceRepoInterface;
use Illuminate\Support\Collection;

class ServiceService implements ServiceServiceInterface
{
    public function __construct(private ServiceRepoInterface $serviceRepo)
    {

    }

    public function getServices(): Collection
    {
        return $this->serviceRepo->getServices();
    }

    public function getServiceById(int $id): ServiceDto
    {
        $service = $this->serviceRepo->findById($id);

        return new ServiceDto(
            id: $service->id,
            name: $service->name,
            label: $service->label,
            description: $service->description,
            price: $service->price,
            duration_minutes: $service->duration_minutes,
            available: $service->available
        );
    }

    public function createService(CreateServiceRequestDto $createServiceRequestDto): CreateServiceResponseDto
    {
        $newService = $this->serviceRepo->createService($createServiceRequestDto->toArray());

        return new CreateServiceResponseDto(
            id: $newService->id,
            name: $newService->name,
            label: $newService->label,
            description: $newService->description,
            price: $newService->price,
            duration_minutes: $newService->duration_minutes,
            available: $newService->available
        );
    }

    public function updateService(int $id, array $data): UpdateServiceResponseDto 
    {
        $updatedService = $this->serviceRepo->updateService($id, $data);

        return new UpdateServiceResponseDto (
            name: $updatedService->name,
            label: $updatedService->label,
            description: $updatedService->description,
            price: $updatedService->price,
            duration_minutes: $updatedService->duration_minutes,
            available: $updatedService->available
        );
    }

    public function deleteService(int $id): bool
    {
        return $this->serviceRepo->deleteService($id);
    }
}