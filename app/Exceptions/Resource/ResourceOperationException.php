<?php

namespace App\Exceptions\Resource;

use Exception;

class ResourceOperationException extends Exception
{
    protected $code = 422;

    public function report(): bool
    {   
        return true;
    }
}
