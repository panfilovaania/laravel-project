<?php

namespace App\Services\Timesheet;

use App\Dto\Timesheet\CreateTimesheetRequestDto;
use App\Exceptions\Operation\OperationException;
use App\Models\Booking;
use App\Models\Timesheet;
use App\Repositories\TimesheetRepo\TimesheetRepoInterface;
use App\Services\Service\ServiceServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class TimesheetService implements TimesheetServiceInterface
{
    public function __construct(private TimesheetRepoInterface $timesheetRepo,
                                private ServiceServiceInterface $serviceService)
    {}

    public function getTimesheets(): Collection
    {
        return $this->timesheetRepo->getTimesheets();
    }

    public function getTimesheetsByFilters(array $filter): Timesheet
    {
        return $this->timesheetRepo->getTimesheetsByFilters($filter)->first();
    }

    public function getTimesheetById(int $id): Timesheet
    {
        return $this->timesheetRepo->findById($id);
    }

    public function createTimesheet(CreateTimesheetRequestDto $dto): Timesheet
    {
        try
        {
            return $this->timesheetRepo->createTimesheet($dto->toArray());
        } 
        catch (\Exception $e)
        {
            Log::channel('timesheet')->error("Ошибка при создании расписания: ", [
                'message' => $e->getTrace(),
                'input' => request()->all()
            ]);

            throw new OperationException("Не удалось создать расписание: {$e->getMessage()}");
        }
    }

    public function updateTimesheet(Timesheet $timesheet, array $data): Timesheet
    {
        try
        {
            return $this->timesheetRepo->updateTimesheet($timesheet, $data);
        }
        catch (\Exception $e)
        {
            Log::channel('timesheet')->error("Ошибка при обновлении расписания: ", [
                'message' => $e->getTrace(),
                'input' => request()->all()
            ]);
            throw new OperationException("Ошибка при обновлении расписания {$timesheet->id}");
        }
    }

    public function deleteTimesheet(Timesheet $timesheet): void
    {
        if (!$this->timesheetRepo->deleteTimesheet($timesheet))
        {
            Log::channel('timesheet')->error("Ошибка при удалении расписания: ", [
                'input' => request()->all()
            ]);
            throw new OperationException("Не удалось удалить расписание");
        }
    }

    public function cancelTimesheetsForBooking(Booking $booking): bool
    {
        try
        {
            $canceledServiceTimesheet = $this->cancelServiceTimesheet($booking);
            
            if (!$canceledServiceTimesheet)
            {
                Log::channel('timesheet')->error('Нет ресурсов для отмены', ['booking_id' => $booking->id]);

                throw new \Exception('Не удалось отменить запись услуги в расписании');
            }
            
            $service = $this->serviceService->getServiceById($booking->service_id);

            if (!$service)
            {
                Log::channel('timesheet')->error('Не удалось найти сервис для бронирования ', ['booking_id' => $booking->id]);

                return false;
            }

            $resources = $service->resources()->get();

            if ($resources->isEmpty())
            {
                Log::channel('timesheet')->error('Нет ресурсов для отмены', ['booking_id' => $booking->id]);

                return false;
            }
            
            $canceledResourceTimesheet = $this->cancelResourceTimesheets($booking, $resources);
            
            if (!$canceledResourceTimesheet)
            {
                Log::channel('timesheet')->error('Не удалось отменить записи ресурсов в расписании', ['booking_id' => $booking->id]);

                throw new \Exception('Не удалось отменить записи ресурсов в расписании');
            }
            
            return true;
        }
        catch (\Exception $e)
        {
            Log::channel('timesheet')->error("Ошибка при отмене записей в расписании: ", [
                'message' => $e
            ]);

            throw new OperationException("Не удалось отменить записи в расписании: {$e}");
        }
    }

    private function cancelServiceTimesheet(Booking $booking): bool
    {
        $timesheet = $this->timesheetRepo->getTimesheetsByFilters([
            'entity_type' => 1,
            'entity_id' => $booking->service_id,
            'date' => $booking->date,
            'start_time' => $booking->start_time,
            'end_time' => $booking->end_time
        ]);

        if (!$timesheet) 
        {
            Log::channel('timesheet')->error('Не удалось найти запись услуги в расписании', ['booking_id' => $booking->id]);
            
            throw new \Exception('Не удалось найти запись услуги в расписании');
        }

        $updatedServiceTimesheet = $this->timesheetRepo->updateTimesheet($timesheet->firstOrFail(), ['timesheet_status_id' => 2]);
               
        if (!$updatedServiceTimesheet)
        {
            Log::channel('timesheet')->error('Не удалось отменить запись услуги в расписании', ['booking_id' => $booking->id]);

            throw new \Exception('Не удалось отменить запись услуги в расписании');
        }

        return true;
    }

    private function cancelResourceTimesheets(Booking $booking, $resources): bool
    {
        $allCancelled = true;

        $service = $this->serviceService->getServiceById($booking->service_id);

        $totalMinutes = Carbon::parse($booking->start_time)->diffInMinutes(Carbon::parse($booking->end_time));

        $resourcesTimesheetsByPeriods = collect();

        $periodsCount = $totalMinutes / $service->duration_minutes;
        
        for ($i=0; $i < $periodsCount; $i++)
        { 
            $start_time = Carbon::parse($booking->start_time)->addMinutes($i*$service->duration_minutes);
            $end_time = Carbon::parse($start_time)->addMinutes($service->duration_minutes);

            $resourcesTimesheets = $this->timesheetRepo->getTimesheetsByFilters([
                'entity_type' => 2,
                'timesheet_status_id' => 1,
                'date' => $booking->date,
                'start_time' => $start_time,
                'end_time' => $end_time
            ]);

            if ($resourcesTimesheets->isEmpty())
            {
                $allCancelled = false;

                Log::error('Не удалось найти ресурсы для отмены');

                throw new \Exception('Не удалось найти ресурсы для отмены');
            }

            $resourcesTimesheetsByPeriods->push($resourcesTimesheets);
        }

        $resourcesTimesheetsForService = $resourcesTimesheetsByPeriods->collapse()
            ->whereIn('entity_id', $resources->pluck('id'));
        
        for ($i=0; $i < $resourcesTimesheetsForService->count(); $i++)
        {
            $timesheet = $resourcesTimesheetsForService->get($i);

            $updatedResourceTimesheet = $this->timesheetRepo->updateTimesheet($timesheet, ['timesheet_status_id' => 2]);
            
            if (!$updatedResourceTimesheet)
            {
                $allCancelled = false;

                Log::error('Не удалось отменить запись ресурса', [
                    'resource_id' => $timesheet->entity_id,
                    'timesheet_id' => $timesheet->id
                ]);

                throw new \Exception('Не удалось отменить запись ресурса в расписании');
            }
        }
        
        return $allCancelled;
    }
}