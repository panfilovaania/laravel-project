<?php

namespace App\Services\Timesheet;

use App\Dto\Service\CreateServiceRequestDto;
use App\Exceptions\Service\ServiceOperationException;
use App\Models\Timesheet;
use App\Repositories\TimesheetRepo\TimesheetRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class TimesheetService implements TimesheetServiceInterface
{
    public function __construct(private TimesheetRepoInterface $timesheetRepo)
    {}

    public function getTimesheets(): Collection
    {
        return $this->timesheetRepo->getTimesheets();
    }

    public function getTimesheetById(int $id): Timesheet
    {
        return $this->timesheetRepo->findById($id);
    }

    public function createTimesheet(CreateServiceRequestDto $dto): Timesheet
    {
        try {
            return $this->timesheetRepo->createTimesheet($dto->toArray());
        } catch (\Exception $e) {
            Log::channel('timesheet')->error("Ошибка при создании расписания: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);

            throw new ServiceOperationException("Не удалось создать расписание: {$e->getMessage()}");
        }
    }

    public function updateTimesheet(Timesheet $timesheet, array $data): Timesheet
    {
        try {
            return $this->timesheetRepo->updateTimesheet($timesheet, $data);
        } catch (\Exception $e) {
            Log::channel('timesheet')->error("Ошибка при обновлении расписания: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);
            throw new ServiceOperationException("Ошибка при обновлении расписания {$timesheet->id}");
        }
    }

    public function deleteTimesheet(Timesheet $timesheet): void
    {
        if (!$this->timesheetRepo->deleteTimesheet($timesheet)) {
            Log::channel('timesheet')->error("Ошибка при удалении расписания: ", [
                'input' => request()->all()
            ]);
            throw new ServiceOperationException("Не удалось удалить расписание");
        }
    }
}