<?php

namespace App\Repositories\BookingRepo;

use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BookingRepoInterface
{
    public function getBookings(int $perPage): LengthAwarePaginator;
    public function findById(int $id): Booking;
    public function findByUser(int $userId): Collection;
    public function createBooking(array $data): Booking;
    public function updateBooking(Booking $booking, array $data): Booking;
    public function cancelBooking(Booking $booking): Booking;
}