<?php

namespace App\Services\Booking;

use App\Dto\Service\CreateServiceRequestDto;
use App\Models\Booking;
use Illuminate\Support\Collection;

interface BookingServiceInterface
{
    public function getBookings(): Collection;

    public function getBookingById(int $id): Booking;

    public function createBooking(CreateServiceRequestDto $createServiceRequestDto): Booking;

    //public function updateService(Service $service, array $data): Service;

    // public function cancelBooking(Booking $booking): Booking;
}