<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Timesheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'entity_type_id',
        'timesheet_status_id',
        'entity_id',
        'date',
        'start_time',
        'end_time',
    ];

    public function timesheetStatuses(): HasMany
    {
        return $this->hasMany(TimesheetStatus::class);
    }
}
