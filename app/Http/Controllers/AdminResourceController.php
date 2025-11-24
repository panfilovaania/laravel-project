<?php

namespace App\Http\Controllers;

use App\Dto\Resource\CreateResourceRequestDto;
use App\Http\Requests\CreateResourceRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Models\Resource;
use App\Services\Resource\ResourceServiceInterface;

class AdminResourceController extends Controller
{
    public function __construct(
        private ResourceServiceInterface $resourceService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = $this->resourceService->getResources();

        return response()->json($resources);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateResourceRequest $request)
    {
        $validated = $request->validated();

        $resourceDto = new CreateResourceRequestDto(
            name: $validated['name'],
            label: $validated['label'],
            available: $validated['available']
        );

        $createdResource = $this->resourceService->createResource($resourceDto);

        return response()->json($createdResource);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        $resource = $this->resourceService->getResourceById($resource->id);

        return response()->json($resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResourceRequest $request, string $id)
    {
        $validated = $request->validated();

        $updatedResource = $this->resourceService->updateResource($id, $validated);

        return response()->json($updatedResource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isDeleted = $this->resourceService->deleteResource($id);

        if (!$isDeleted) 
        {
            return response()->json(['message' => "Ресурс с идентификатором {$id} не найден"], 404);
        }
    
        return response()->noContent();
    }
}
