<?php

namespace App\Services\Booking;

use App\Models\Service;
use Illuminate\Support\Collection;

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
                                    string $endTime,
                                    int $duration_minutes,
                                    int $requiredResources): Collection;
}