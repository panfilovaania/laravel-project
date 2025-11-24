<?php

namespace App\Services\Resource;

use App\Dto\Resource\CreateResourceRequestDto;
use App\Models\Resource;
use App\Repositories\ResourceRepo\ResourceRepoInterface;
use App\Services\Resource\ResourceServiceInterface;
use Illuminate\Support\Collection;

class ResourceService implements ResourceServiceInterface
{
    public function __construct(private ResourceRepoInterface $resourceRepo)
    {}

    public function getResources(): Collection
    {
        return $this->resourceRepo->getResources();
    }

    public function getResourceById(int $id): Resource
    {
        return $this->resourceRepo->findById($id);
    }

    public function createResource(CreateResourceRequestDto $createResourceRequestDto): Resource
    {
        return $this->resourceRepo->createResource($createResourceRequestDto->toArray());
    }

    public function updateResource(int $id, array $data): Resource 
    {
        return $this->resourceRepo->updateResource($id, $data);
    }

    public function deleteResource(int $id): bool
    {
        return $this->resourceRepo->deleteResource($id);
    }
}