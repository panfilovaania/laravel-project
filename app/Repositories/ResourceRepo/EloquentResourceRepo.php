<?php

namespace App\Repositories\ResourceRepo;

use App\Models\Resource;
use Illuminate\Support\Collection;

class EloquentResourceRepo implements ResourceRepoInterface
{
    public function getResources(): Collection
    {
        return Resource::all();
    }

    public function findById(int $id): Resource 
    {
        return Resource::findOrFail($id);
    }

    public function createResource(array $data): Resource
    {
        return Resource::create([
            'name' => $data['name'],
            'label' => $data['label'],
            'available' => $data['available'],
        ]);
    }

    public function updateResource(int $id, array $data): Resource
    {
        $resource = Resource::findOrFail($id);

        $resource->update($data);
        
        return $resource->fresh();
    }

    public function deleteResource(int $id): bool
    {
        return Resource::findOrFail($id)->delete();
    }
}