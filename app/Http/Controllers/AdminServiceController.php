<?php

namespace App\Http\Controllers;

use App\Dto\Service\CreateServiceRequestDto;
use App\Http\Requests\CreateServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Services\Service\ServiceServiceInterface;
use Illuminate\Support\Facades\Cache;

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
        $services = Cache::remember('services', 300, fn() => $this->serviceService->getServices());

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

        Cache::forget('services');

        Cache::remember('services', 300, fn() => $this->serviceService->getServices());

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

        Cache::forget('services');

        Cache::remember('services', 300, fn() => $this->serviceService->getServices());

        return response()->json($updatedService);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $this->serviceService->deleteService($service);

        Cache::forget('services');

        Cache::remember('services', 300, fn() => $this->serviceService->getServices());
    
        return response()->noContent();
    }
}
