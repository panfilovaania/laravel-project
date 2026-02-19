<?php

namespace App\Repositories\TimesheetRepo;

use App\Models\Timesheet;
use Illuminate\Support\Collection;

class EloquentTimesheetRepo implements TimesheetRepoInterface
{
    public function getTimesheets(): Collection
    {
        return Timesheet::all();
    }

    public function findById(int $id): Timesheet 
    {
        return Timesheet::findOrFail($id);
    }

    public function createTimesheet(array $data): Timesheet
    {
        return Timesheet::create([
            'name' => $data['name'],
            'label' => $data['label'],
            'description' => $data['description'],
            'price' => $data['price'],
            'duration_minutes' => $data['duration_minutes'],
            'available' => $data['available'],
        ]);
    }

    public function updateTimesheet(Timesheet $timesheet, array $data): Timesheet 
    {
        $timesheet->update($data);
        
        return $timesheet->fresh();
    }

    public function deleteTimesheet(Timesheet $timesheet): bool
    {
        return $timesheet->delete();
    }
}