<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateResourceRequest;
use App\Http\Requests\GetTimesheetsByFilterRequest;
use App\Http\Requests\UpdateResourceRequest;
use App\Models\Booking;
use App\Models\Resource;
use App\Models\Timesheet;
use App\Services\Timesheet\TimesheetServiceInterface;

class TimesheetController extends Controller
{

    public function __construct(private TimesheetServiceInterface $timesheetService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $timesheets = $this->timesheetService->getTimesheets();

        return response()->json($timesheets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateResourceRequest $request)
    {
        // $validated = $request->validated();
        
        // $resourceDto = new CreateResourceRequestDto(
        //     name: $validated['name'],
        //     label: $validated['label'],
        //     available: $validated['available']
        // );

        // $createdResource = $this->resourceService->createResource($resourceDto);

        // return response()->json($createdResource);
    }

    /**
     * Display the specified resource.
     */
    public function show(Timesheet $timesheet)
    {
        return response()->json($timesheet);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResourceRequest $request, Resource $resource)
    {
        // $validated = $request->validated();

        // $updatedResource = $this->resourceService->updateResource($resource, $validated);

        // return response()->json($updatedResource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource)
    {
        // $this->resourceService->deleteResource($resource);
    
        // return response()->noContent();
    }

    public function getTimesheetsByFilter(GetTimesheetsByFilterRequest $request)
    {
        $validated = $request->validated();

        $timesheets = $this->timesheetService->getTimesheetsByFilters($validated);

        return response()->json($timesheets);
    }

    public function cancelTimesheetsForBooking(Booking $booking)
    {
        $timesheets = $this->timesheetService->cancelTimesheetsForBooking($booking);

        return response()->json($timesheets);
    }
}
