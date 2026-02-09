<?php

namespace App\Repositories\ServiceRepo;

use App\Models\Service;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;


class CacheEloquentServiceRepo implements ServiceRepoInterface
{

    public function __construct(private EloquentServiceRepo $serviceRepo)
    {
        
    }

    public function getServices(): Collection
    {
        return Cache::remember('services', 300, fn() => $this->serviceRepo->getServices());
    }

    public function findById(int $id): Service
    {
        return Service::findOrFail($id);
    }

    public function createService(array $data): Service
    {
        $service = $this->serviceRepo->createService($data);

        Cache::forget('services');

        Cache::remember('services', 300, fn() => $this->serviceRepo->getServices());

        return $service;
    }

    public function updateService(Service $service, array $data): Service 
    {
        $updatedService = $this->serviceRepo->updateService($service, $data);

        Cache::forget('services');

        Cache::remember('services', 300, fn() => $this->serviceRepo->getServices());
        
        return $updatedService;
    }

    public function deleteService(Service $service): bool
    {
        $isDeleted = $this->serviceRepo->deleteService($service);

        Cache::forget('services');

        Cache::remember('services', 300, fn() => $this->serviceRepo->getServices());
        
        return $isDeleted;
    }
}