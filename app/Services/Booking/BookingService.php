<?php

namespace App\Services\Booking;

use App\Dto\Booking\CreateBookingRequestDto;
use App\Exceptions\Operation\OperationException;
use App\Models\Booking;
use App\Models\User;
use App\Repositories\BookingRepo\BookingRepoInterface;
use App\Services\Timesheet\TimesheetServiceInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingService implements BookingServiceInterface
{
    public function __construct(private BookingRepoInterface $bookingRepo,
                                private TimesheetServiceInterface $timesheetService,
                                )
    {}

    public function getBookings(): Collection
    {
        return $this->bookingRepo->getBookings();
    }

    public function getBookingById(int $id): Booking
    {
        return $this->bookingRepo->findById($id);
    }

    public function getBookingsByUser(User $user): Collection
    {
        return $this->bookingRepo->findByUser($user->id);
    }

    public function createBooking(CreateBookingRequestDto $dto): Booking
    {
        try {
            return $this->bookingRepo->createBooking($dto->toArray());
        } catch (\Exception $e) {
            Log::channel('booking')->error("Ошибка при создании бронирования: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);

            throw new OperationException("Не удалось создать бронирование: {$e->getMessage()}");
        }
    }

    public function updateBooking(Booking $booking, array $data): Booking
    {
        try {
            return $this->bookingRepo->updateBooking($booking, $data);
        } catch (\Exception $e) {
            Log::channel('booking')->error("Ошибка при обновлении бронирования: ", [
                'message' => $e->getMessage(),
                'input' => request()->all()
            ]);
            throw new OperationException("Ошибка при обновлении бронирования {$booking->id}");
        }
    }

    public function cancelBooking(Booking $booking): Booking
    {
        DB::beginTransaction();

        try
        {
            $canceledBooking = $this->bookingRepo->cancelBooking($booking);

            if (!$canceledBooking) {
                throw new \Exception('Не удалось обновить статус бронирования');
            }

            if (!$this->timesheetService->cancelTimesheetsForBooking($booking)) {
                throw new \Exception('Не удалось отменить записи в расписании');
            }

            DB::commit();

            Log::channel('booking')->info('Бронирование успешно отменено', ['booking_id' => $booking->id]);

            return $canceledBooking;
        }
        catch (\Exception $e) {
            DB::rollBack();

            Log::channel('booking')->error("Ошибка при отмене бронирования: ", [
                'booking_id' => $booking->id,
                'message' => $e
            ]);

            throw new OperationException("Не удалось отменить бронирование");
        }
    }
}