<?php

namespace App\Services\Booking;

use App\Dto\Booking\CreateBookingRequestDto;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Collection;

interface BookingServiceInterface
{
    public function getBookings(): Collection;

    public function getBookingById(int $id): Booking;

    public function getBookingsByUser(User $user): Collection;

    public function createBooking(CreateBookingRequestDto $dto): Booking;

    public function updateBooking(Booking $booking, array $data): Booking;

    public function cancelBooking(Booking $booking): Booking;
}