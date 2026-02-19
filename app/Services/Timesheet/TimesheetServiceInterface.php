<?php

namespace App\Services\Timesheet;

use App\Dto\Service\CreateServiceRequestDto;
use App\Models\Timesheet;
use Illuminate\Support\Collection;

interface TimesheetServiceInterface
{
    public function getTimesheets(): Collection;

    public function getTimesheetById(int $id): Timesheet;

    public function createTimesheet(CreateServiceRequestDto $createServiceRequestDto): Timesheet;

    public function updateTimesheet(Timesheet $timesheet, array $data): Timesheet;

    public function deleteTimesheet(Timesheet $timesheet): void;
}