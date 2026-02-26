<?php

namespace App\Exceptions\Operation;

use Exception;

class OperationException extends Exception
{
    protected $code = 422;

    public function report(): bool
    {   
        return true;
    }
}
