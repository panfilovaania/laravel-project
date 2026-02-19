<?php

namespace App\Services\Booking;

use App\Dto\Service\CreateServiceRequestDto;
use App\Exceptions\Service\ServiceOperationException;
use App\Models\Booking;
use App\Repositories\BookingRepo\BookingRepoInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

class BookingService implements BookingServiceInterface
{
    public function __construct(private BookingRepoInterface $bookingRepo)
    {}

    public function getBookings(): Collection
    {
        return $this->bookingRepo->getBookings();
    }

    public function getBookingById(int $id): Booking
    {
        return $this->bookingRepo->findById($id);
    }

    public function createBooking(CreateServiceRequestDto $dto): Booking
    {
        try {
            return $this->bookingRepo->createBooking($dto->toArray());
        } catch (\Exception $e) {
            Log::channel('booking')->error("Ошибка при создании бронирования: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);

            throw new ServiceOperationException("Не удалось создать бронирование: {$e->getMessage()}");
        }
    }

    // public function updateService(Service $service, array $data): Service
    // {
    //     try {
    //         return $this->serviceRepo->updateService($service, $data);
    //     } catch (\Exception $e) {
    //         Log::channel('service')->error("Ошибка при обновлении сервиса: ", [
    //             'message' => $e->getMessage(),
    //             'input' => request()->all()
    //         ]);
    //         throw new ServiceOperationException("Ошибка при обновлении услуги {$service->id}");
    //     }
    // }

    // public function cancelBooking(Booking $booking): bool
    // {
    //     if (!$this->bookingRepo->cancelBooking($booking)) {
    //         Log::channel('booking')->error("Ошибка при отмене бронирования: ", [
    //             'input' => request()->all()
    //         ]);
    //         throw new ServiceOperationException("Не удалось удалить бронирование");
    //     }
    // }
}