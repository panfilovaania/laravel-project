<?php

namespace App\Services\Service;

use App\Dto\Service\CreateServiceRequestDto;
use App\Models\Service;
use App\Repositories\ServiceRepo\ServiceRepoInterface;
use Illuminate\Support\Collection;

class ServiceService implements ServiceServiceInterface
{
    public function __construct(private ServiceRepoInterface $serviceRepo)
    {}

    public function getServices(): Collection
    {
        return $this->serviceRepo->getServices();
    }

    public function getServiceById(int $id): Service
    {
        return $this->serviceRepo->findById($id);
    }

    public function createService(CreateServiceRequestDto $createServiceRequestDto): Service
    {
        return $this->serviceRepo->createService($createServiceRequestDto->toArray());
    }

    public function updateService(Service $service, array $data): Service
    {
        return $this->serviceRepo->updateService($service, $data);
    }

    public function deleteService(Service $service): bool
    {
        return $this->serviceRepo->deleteService($service);
    }
}