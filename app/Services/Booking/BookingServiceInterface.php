<?php

namespace App\Services\Booking;

use App\Dto\Booking\CreateBookingRequestDto;
use App\Models\Booking;
use Illuminate\Support\Collection;

interface BookingServiceInterface
{
    public function getBookings(): Collection;

    public function getBookingById(int $id): Booking;

    public function createBooking(CreateBookingRequestDto $dto): Booking;

    public function updateBooking(Booking $booking, array $data): Booking;

    public function cancelBooking(Booking $booking): Booking;
}