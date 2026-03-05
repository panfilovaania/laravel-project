<?php

namespace App\Repositories\TimesheetRepo;

use App\Models\Timesheet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class EloquentTimesheetRepo implements TimesheetRepoInterface
{
    private array $allowedFilters = [
        'entity_type_id',
        'timesheet_status_id',
        'entity_id',
        'date',
        'start_time',
        'end_time'
    ];

    public function getTimesheets(): Collection
    {
        return Timesheet::all();
    }

    public function getTimesheetsByFilters(array $filters): Collection
    {
        $query = Timesheet::query();

        foreach($this->allowedFilters as $field)
        {
            if (array_key_exists($field, $filters) && $filters !== null)
            {
                $query->where($field, $filters[$field]);
            }
        }

       return $query->get();
    }

    public function findById(int $id): Timesheet 
    {
        return Timesheet::findOrFail($id);
    }

    public function createTimesheet(array $data): Timesheet
    {
        return Timesheet::create([
            'entity_type_id' => $data['entity_type_id'],
            'timesheet_status_id' => $data['timesheet_status_id'],
            'entity_id' => $data['entity_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
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