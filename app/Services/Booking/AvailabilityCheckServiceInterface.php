<?php

namespace App\Services\Booking;

use App\Dto\Booking\CreateBookingRequestDto;
use App\Exceptions\Operation\OperationException;
use App\Models\Booking;
use App\Models\Resource;
use App\Models\Service;
use App\Models\Timesheet;
use App\Repositories\BookingRepo\BookingRepoInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

interface AvailabilityCheckServiceInterface
{
    public function checkAvailability(Service $service, 
                                    string $date, 
                                    string $startTime, 
                                    string $endTime,
                                    int $requiredResources = 1
                                ): bool;
    public function getAvailableResources(Collection $resources, 
                                    string $date, 
                                    string $startTime, 
                                    string $endTime): Collection;
    
    // public function getAvailableSlots(
    //     Service $service, 
    //     Carbon $date, 
    //     int $requiredResources = 1
    // ): Collection;
}