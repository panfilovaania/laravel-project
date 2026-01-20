<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Support\Facades\Log;

class InvalidCredentialsException extends Exception
{
    protected $message = 'Неверный логин или пароль.';
    protected $code = 401;

    public function report(): bool
    {
        Log::warning($this->message, [
            'email' => request('email'),
        ]);
        
        return true; 
    }
}
