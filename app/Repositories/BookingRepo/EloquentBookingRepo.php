<?php

namespace App\Repositories\BookingRepo;

use App\Models\Booking;
use Exception;
use Illuminate\Support\Collection;

class EloquentBookingRepo implements BookingRepoInterface
{
    public function getBookings(): Collection
    {
        return Booking::all();
    }

    public function findById(int $id): Booking 
    {
        return Booking::findOrFail($id);
    }

    public function createBooking(array $data): Booking
    {
        return Booking::create([
            'user_id' => $data['user_id'],
            'city_id' => $data['city_id'],
            'location_id' => $data['location_id'],
            'service_id' => $data['service_id'],
            'timesheet_id' => $data['timesheet_id'],
            'booking_status_id' => $data['booking_status_id'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'persons' => $data['persons'],
            'total_price' => $data['total_price'],
        ]);
    }

    public function updateBooking(Booking $booking, array $data): Booking 
    {
        $booking->update($data);
        
        return $booking->fresh();
    }

    public function cancelBooking(Booking $booking): Booking
    {
        $booking->update([
            'booking_status_id' => 2,
        ]);
        return $booking->fresh();
    }
}