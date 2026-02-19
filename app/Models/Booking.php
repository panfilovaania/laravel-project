<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'city_id',
        'location_id',
        'service_id',
        'timesheet_id',
        'booking_status_id',
        'date',
        'start_time',
        'end_time',
        'persons',
        'total_price'
    ];

    public function bookingStatus(): BelongsTo
    {
        return $this->belongsTo(BookingStatus::class);
    }
}
