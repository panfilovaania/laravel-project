<?php

namespace App\Services\Booking;

use App\Exceptions\Operation\OperationException;
use App\Models\Service;
use App\Models\Timesheet;
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
        if (!$service->available)
        {
            Log::channel('booking')->error("Услуга недоступна: ", [
                'service' => [
                    'id' => $service->id,
                    'name' => $service->name]
            ]);
            throw new OperationException("Услуга недоступна");
        }

        if ($service->resources_count < $requiredResources)
        {
            Log::channel('booking')->error("Превышено кол-во человек. Требуемое: {$requiredResources}, максимальное: {$service->resources_count}");
            throw new OperationException("Превышено кол-во человек. Максимально доступно: {$service->resources_count}");
        }
        
        if (Carbon::parse($startTime)->diffInMinutes(Carbon::parse($endTime)) < $service->duration_minutes)
        {
            Log::channel('booking')->error("Минимальное время услуги: {$service->duration_minutes}");
            throw new OperationException("Минимальное время услуги: {$service->duration_minutes}");
        }

        $serviceResources = $service->resources;
        
        if ($serviceResources->isEmpty()) {
            return false;
        }
        
        return true;
    }
    
    public function getAvailableResources(
                    Collection $resources, 
                    string $date, 
                    string $startTime, 
                    string $endTime,
                    int $duration_minutes,
                    int $requiredResources
                ): Collection
    {
        $totalMinutes = Carbon::parse($startTime)->diffInMinutes(Carbon::parse($endTime));

        $availableResourcesByPeriods = collect();

        $periodsCount = $totalMinutes / $duration_minutes;
        
        for ($i=0; $i < $periodsCount; $i++)
        { 
            $st = Carbon::parse($startTime)->addMinutes($i*$duration_minutes);
            $et = Carbon::parse($st)->addMinutes($duration_minutes);

            $result = $resources->filter(function ($resource) use ($date, $st, $et) {
                return $this->isAvailable(2, $resource->id, Carbon::parse($date), $st, $et);
            });

            if ($result->count() < $requiredResources)
            {
                return collect();
            }
            
            $availableResourcesByPeriods->push($result);
        }

        return $availableResourcesByPeriods;
    }
    
    protected function isAvailable(
        int $entity_type_id,
        int $entity_id,
        Carbon $date, 
        Carbon $startTime, 
        Carbon $endTime,
    ): bool
    {
       $query = Timesheet::where('entity_type_id', $entity_type_id)
            ->where('timesheet_status_id', 1)
            ->where('entity_id', $entity_id)
            ->where('date', $date->toDateString());

        $query->where(function($q) use ($startTime, $endTime) {
            $q->where('start_time', '<=', $startTime->toTimeString())
            ->where('end_time', '>=', $endTime->toTimeString());
        });

        return !$query->exists();
    }
}