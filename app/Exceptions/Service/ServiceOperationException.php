<?php

namespace App\Exceptions\Service;

use Exception;

class ServiceOperationException extends Exception
{
    protected $code = 422;

    public function report(): bool
    {   
        return true;
    }
}
