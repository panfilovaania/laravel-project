<?php

namespace App\Repositories\ServiceRepo;

use App\Models\Service;
use Illuminate\Support\Collection;

class EloquentServiceRepo implements ServiceRepoInterface
{
    public function getServices(): Collection
    {
        return Service::all();
    }

    public function findById(int $id): Service 
    {
        return Service::findOrFail($id);
    }

    public function createService(array $data): Service
    {
        return Service::create([
            'name' => $data['name'],
            'label' => $data['label'],
            'description' => $data['description'],
            'price' => $data['price'],
            'duration_minutes' => $data['duration_minutes'],
            'available' => $data['available'],
        ]);
    }

    public function updateService(Service $service, array $data): Service 
    {
        $service->update($data);
        
        return $service->fresh();
    }

    public function deleteService(Service $service): bool
    {
        return $service->delete();
    }
}