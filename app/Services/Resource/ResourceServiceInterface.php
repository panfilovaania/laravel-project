<?php

namespace App\Services\Resource;

use App\Dto\Resource\CreateResourceRequestDto;
use App\Models\Resource;
use Illuminate\Support\Collection;

interface ResourceServiceInterface
{
    public function getResources(): Collection;

    public function getResourceById(int $id): Resource;

    public function createResource(CreateResourceRequestDto $createResourceRequestDto): Resource;

    public function updateResource(Resource $resource, array $data): Resource;

    public function deleteResource(Resource $resource): void;
}