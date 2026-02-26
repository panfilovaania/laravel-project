<?php

namespace App\Dto\Booking;

use Carbon\Carbon;

class CreateBookingRequestDto
{
    public function __construct(
        public int $user_id,
        public int $city_id,
        public int $location_id,
        public int $service_id,
        public int $timesheet_id,
        public int $booking_status_id,
        public Carbon $date,
        public Carbon $start_time,
        public Carbon $end_time,
        public int $persons,
        public float $total_price
    ) {
        
    }

    public function toArray()
    {
        return [
            'user_id' => $this->user_id,
            'city_id' => $this->city_id,
            'location_id' => $this->location_id,
            'service_id' => $this->service_id,
            'timesheet_id' => $this->timesheet_id,
            'booking_status_id' => $this->booking_status_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'persons' => $this->persons,
            'total_price' => $this->total_price
        ];
    }
}