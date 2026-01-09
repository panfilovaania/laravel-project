<?php

namespace App\Repositories\ResourceRepo;

use App\Models\Resource;
use Illuminate\Support\Collection;

interface ResourceRepoInterface
{
    public function getResources(): Collection;
    public function findById(int $id): Resource;
    public function createResource(array $data): Resource;
    public function updateResource(int $id, array $data): Resource;
    public function deleteResource(int $id): bool;
}