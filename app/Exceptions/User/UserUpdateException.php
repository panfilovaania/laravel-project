<?php

namespace App\Exceptions\User;

use Exception;

class UserUpdateException extends Exception
{
    protected $message = 'Не удалось обновить данные пользователя';
    protected $code = 422;

    public function report(): bool
    {
        return true;
    }
}
