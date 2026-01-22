<?php

namespace App\Http\Controllers;

use App\Dto\Service\CreateServiceRequestDto;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Services\Service\ServiceServiceInterface;

class AdminServiceController extends Controller
{
    private $serviceService;

    public function __construct(ServiceServiceInterface $serviceService)
    {
        $this->serviceService = $serviceService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = $this->serviceService->getServices();

        return response()->json($services);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateServiceRequest $request)
    {
        $validated = $request->validated();
        
        $serviceDto = new CreateServiceRequestDto(
            name: $validated['name'],
            label: $validated['label'],
            description: $validated['description'],
            price: $validated['price'],
            duration_minutes: $validated['duration_minutes'],
            available: $validated['available']
        );

        $createdService = $this->serviceService->createService($serviceDto);

        return response()->json($createdService);
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        // $service = $this->serviceService->getServiceById($service->id);

        return response()->json($service);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $validated = $request->validated();

        $updatedService = $this->serviceService->updateService($service, $validated);

        return response()->json($updatedService);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $isDeleted = $this->serviceService->deleteService($service);

        if (!$isDeleted) 
        {
            return response()->json(['message' => "Сервис с идентификатором {$service->id} не найден"], 404);
        }
    
        return response()->noContent();
    }
}
