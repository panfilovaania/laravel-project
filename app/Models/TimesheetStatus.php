<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TimesheetStatus extends Model
{
    use HasFactory;

    public function timesheet(): BelongsTo
    {
        return $this->belongsTo(Timesheet::class);
    }
}
