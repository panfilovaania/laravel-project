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

class AvailabilityCheckService implements AvailabilityCheckServiceInterface
{
    public function checkAvailability(
        Service $service, 
        string $date, 
        string $startTime, 
        string $endTime,
        int $requiredResources = 1
    ): bool
    {
        if(!$service->available || $service->resources_count < $requiredResources)
        {
            // dump("Услуга доступна? - НЕТ. service->available: {$service->available} || {$service->resources_count} < {$requiredResources}");
            return false;
        }

        $serviceResources = $service->resources;
        
        if ($serviceResources->isEmpty()) {
            // dump("Есть связанные с услугой ресурсы? - НЕТ");
            return false;
        }
        
        $isServiceAvailable = $this->isAvailable(2, $service->id, Carbon::parse($date), Carbon::parse($startTime), Carbon::parse($endTime));
        // dump("Услуга доступна для брони на это время? - {$isServiceAvailable}");
        $availableResources = $this->getAvailableResources(
            $serviceResources, 
            $date, 
            $startTime, 
            $endTime
        );

        // dump("Ресурсы доступны для брони на это время? - {$availableResources->count()}");
        $result = $availableResources->count() >= $requiredResources && $isServiceAvailable;

        // dump("Итог: Кол-во ресурсов {$availableResources->count()} >= Необходимые ресурсы {$requiredResources} && Сервис свободен {$isServiceAvailable}");
        return $result;
    }
    
    public function getAvailableResources(
                    Collection $resources, 
                    string $date, 
                    string $startTime, 
                    string $endTime
                ): Collection 
    {
        return $resources->filter(function ($resource) use ($date, $startTime, $endTime) {
            return $this->isAvailable(2, $resource->id, Carbon::parse($date), Carbon::parse($startTime), Carbon::parse($endTime));
        });
    }
    
    protected function isAvailable(
        int $entity_type_id,
        int $entity_id,
        Carbon $date, 
        Carbon $startTime, 
        Carbon $endTime
    ): bool
    {
       $query = Timesheet::where('entity_type_id', $entity_type_id)
            ->where('timesheet_status_id', 1)
            ->where('entity_id', $entity_id)
            ->where('date', $date);

        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('start_time', '<', $startTime)
            ->where('end_time', '>', $endTime);
        });

        return !$query->exists();
    }
    
    // public function getAvailableSlots(
    //     Service $service, 
    //     Carbon $date, 
    //     int $requiredResources = 1
    // ): Collection {
    //     $serviceResources = $service->resources;
    //     $allTimesheets = Timesheet::where('entity_type_id', 'resource')
    //         ->whereIn('entity_id', $serviceResources->pluck('id'))
    //         ->where('date', $date->toDateString())
    //         ->get()
    //         ->groupBy('entity_id');
        
    //     // Здесь логика для определения свободных временных промежутков
    //     // на основе занятости всех ресурсов
        
    //     return collect(); // Вернуть коллекцию доступных слотов
    // }
}