<?php

namespace App\Repositories\TimesheetRepo;

use App\Models\Timesheet;
use Illuminate\Support\Collection;

interface TimesheetRepoInterface
{
    public function getTimesheets(): Collection;
    public function getTimesheetsByFilters(array $filters): Collection;
    public function findById(int $id): Timesheet;
    public function createTimesheet(array $data): Timesheet;
    public function updateTimesheet(Timesheet $timesheet, array $data): Timesheet;
    public function deleteTimesheet(Timesheet $timesheet): bool;
}