<?php

namespace App\Repositories\BookingRepo;

use App\Models\Booking;
use Illuminate\Support\Collection;

interface BookingRepoInterface
{
    public function getBookings(): Collection;
    public function findById(int $id): Booking;
    public function createBooking(array $data): Booking;
    // public function updateService(Service $service, array $data): Service;
    // public function cancelBooking(Booking $booking): Booking;
}