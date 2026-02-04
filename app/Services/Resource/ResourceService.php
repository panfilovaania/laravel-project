<?php

namespace App\Services\Resource;

use App\Dto\Resource\CreateResourceRequestDto;
use App\Exceptions\Resource\ResourceOperationException;
use App\Models\Resource;
use App\Repositories\ResourceRepo\ResourceRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

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
        try {
            return $this->resourceRepo->createResource($createResourceRequestDto->toArray());
        } catch (\Exception $e) {
            Log::channel('resource')->error("Ошибка при создании ресурса: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);

            throw new ResourceOperationException("Не удалось создать ресурс: {$e->getMessage()}");
        }
    }

    public function updateResource(Resource $resource, array $data): Resource
    {
        try {
            return $this->resourceRepo->updateResource($resource, $data);
        } catch (\Exception $e) {
            Log::channel('resource')->error("Ошибка при обновлении ресурса: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);
            throw new ResourceOperationException("Ошибка при обновлении ресурса {$resource->id}");
        }
    }

    public function deleteResource(Resource $resource): void
    {
        if (!$this->resourceRepo->deleteResource($resource)) {
            Log::channel('resource')->error("Ошибка при удалении ресурса: ", [
                'input' => request()->all()
            ]);
            throw new ResourceOperationException("Не удалось удалить ресурс");
        }
    }
}