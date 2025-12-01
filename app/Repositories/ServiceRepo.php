<?php

namespace App\Repositories;

use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceRepo implements ServiceRepoInterface
{
    public function getServices(): \Illuminate\Database\Eloquent\Collection
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

    public function updateService(int $id, array $data): Service 
    {
        $service = Service::findOrFail($id);

        $service->update($data);
        
        return $service->fresh();
    }

    public function deleteService(int $id): bool
    {
        return Service::findOrFail($id)->delete();
    }
}