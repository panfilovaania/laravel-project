<?php

namespace App\Exceptions\Service;

use Exception;
use Illuminate\Support\Facades\Log;

class ServiceOperationException extends Exception
{
    protected $code = 422;

    public function report(): bool
    {
        Log::error("Ошибка операции с сервисом: {$this->message}", [
            'input' => request()->all()
        ]);
        
        return true;
    }
}
