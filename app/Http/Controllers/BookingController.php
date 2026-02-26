<?php

namespace App\Http\Controllers;

use App\Dto\Booking\CreateBookingRequestDto;
use App\Dto\Timesheet\CreateTimesheetRequestDto;
use App\Http\Requests\CreateBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Models\Booking;
use App\Services\Booking\AvailabilityCheckServiceInterface;
use App\Services\Booking\BookingServiceInterface;
use App\Services\Service\ServiceServiceInterface;
use App\Services\Timesheet\TimesheetServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{
    public function __construct(private BookingServiceInterface $bookingService,
                                private TimesheetServiceInterface $timesheetService,                  
                                private AvailabilityCheckServiceInterface $availabilityCheckService,                  
                                private ServiceServiceInterface $serviceService                         
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = $this->bookingService->getBookings();

        return response()->json($bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateBookingRequest $request)
    {
        $validated = $request->validated();

        $service = $this->serviceService->getServiceById($validated['service_id']);

        $checkAvailable = $this->availabilityCheckService->checkAvailability($service,
                                                                            $validated['date'],
                                                                            $validated['start_time'],
                                                                            $validated['end_time'],
                                                                            $validated['persons']);

        if(!$checkAvailable)
        {
            return response()->json('На это время услуга уже забронирована. Пожалуйста, выберите другое время');
        }

        $serviceTimesheetDto = new CreateTimesheetRequestDto(
            entity_type_id: 1,
            timesheet_status_id: 1,
            entity_id: $validated['service_id'],
            date: Carbon::parse($validated['date']),
            start_time: Carbon::parse($validated['start_time']),
            end_time: Carbon::parse($validated['end_time']),
        ); 

        $serviceTimesheet = $this->timesheetService->createTimesheet($serviceTimesheetDto);
        
        $availableResources = $this->availabilityCheckService->getAvailableResources($service->resources()->get(), 
                                                                                    $validated['date'],
                                                                                    $validated['start_time'],
                                                                                    $validated['end_time']);
    
        if ($availableResources->count() >= $service->persons || $availableResources->count() == 0)
        {
            for ($i=0; $i < $validated['persons']; $i++) { 
                $this->timesheetService->createTimesheet(
                    new CreateTimesheetRequestDto(
                        entity_type_id: 2,
                        timesheet_status_id: 1,
                        entity_id: $availableResources->get($i)->id,
                        date: Carbon::parse($validated['date']),
                        start_time: Carbon::parse($validated['start_time']),
                        end_time: Carbon::parse($validated['end_time']),
                    )
                );
            }
        }                                                                          

        $bookingDto = new CreateBookingRequestDto(
            user_id: Auth::id(),
            city_id: $validated['city_id'],
            location_id: $validated['location_id'],
            service_id: $service->id,
            timesheet_id: $serviceTimesheet->id,
            booking_status_id: 1,
            date: Carbon::parse($validated['date']),
            start_time: Carbon::parse($validated['start_time']),
            end_time: Carbon::parse($validated['end_time']),
            persons: $validated['persons'],
            total_price: $service->price*$validated['persons']
        ); 

        $createdBooking = $this->bookingService->createBooking($bookingDto);

        return response()->json($createdBooking);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return response()->json($booking);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookingRequest $request, Booking $booking)
    {
        $validated = $request->validated();

        $updatedBooking = $this->bookingService->updateBooking($booking, $validated);

        return response()->json($updatedBooking);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function cancelBooking(Booking $booking)
    {
        $canceledBooking = $this->bookingService->cancelBooking($booking);

        return response()->json($canceledBooking);
    }
}
