<?php

namespace App\Exceptions\Auth;

use Exception;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Неверный логин или пароль.';
    protected $code = 401;

    public function report(): bool
    {
        return true; 
    }
}
