<?php

namespace App\Dto\Timesheet;

use Carbon\Carbon;

class CreateTimesheetRequestDto
{
    public function __construct(
        public int $entity_type_id,
        public int $timesheet_status_id,
        public int $entity_id,
        public Carbon $date,
        public Carbon $start_time,
        public Carbon $end_time,
    ) {
        
    }

    public function toArray()
    {
        return [
            'entity_type_id' => $this->entity_type_id,
            'timesheet_status_id' => $this->timesheet_status_id,
            'entity_id' => $this->entity_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
        ];
    }
}