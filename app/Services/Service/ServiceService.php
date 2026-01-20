<?php

namespace App\Services\Service;

use App\Dto\Service\CreateServiceRequestDto;
use App\Exceptions\Service\ServiceOperationException;
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
         try {
            return $this->serviceRepo->createService($createServiceRequestDto->toArray());
        } catch (\Exception $e) {
            throw new ServiceOperationException("Не удалось создать услугу: {$e->getMessage()}");
        }
    }

    public function updateService(Service $service, array $data): Service
    {
        try {
            return $this->serviceRepo->updateService($service, $data);
        } catch (\Exception $e) {
            throw new ServiceOperationException("Ошибка при обновлении услуги {$service->id}");
        }
    }

    public function deleteService(Service $service): void
    {
        if (!$this->serviceRepo->deleteService($service)) {
            throw new ServiceOperationException("Не удалось удалить услугу");
        }
    }
}