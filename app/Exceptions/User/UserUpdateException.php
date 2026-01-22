<?php

namespace App\Exceptions\User;

use Exception;
use Illuminate\Support\Facades\Log;

class UserUpdateException extends Exception
{
    protected $message = 'Не удалось обновить данные пользователя';
    protected $code = 422;

    public function report(): bool
    {
        Log::error("Ошибка обновления пользователя: {$this->message}");

        return true;
    }
}
