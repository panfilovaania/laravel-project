<?php

namespace App\Services\Timesheet;

use App\Dto\Timesheet\CreateTimesheetRequestDto;
use App\Models\Booking;
use App\Models\Timesheet;
use Illuminate\Support\Collection;

interface TimesheetServiceInterface
{
    public function getTimesheets(): Collection;

    public function getTimesheetsByFilters(array $filter): Timesheet;

    public function getTimesheetById(int $id): Timesheet;

    public function createTimesheet(CreateTimesheetRequestDto $dto): Timesheet;

    public function updateTimesheet(Timesheet $timesheet, array $data): Timesheet;

    public function deleteTimesheet(Timesheet $timesheet): void;

    public function cancelTimesheetsForBooking(Booking $booking): bool;
}