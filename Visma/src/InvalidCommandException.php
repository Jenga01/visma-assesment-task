<?php
declare(strict_types=1);

namespace App;

use Exception;
use Throwable;

class InvalidCommandException extends Exception
{
    protected string $errorType;

    public function __construct($errorType, $message, $code = 0, Throwable $previous = null)
    {
        $this->errorType = $errorType;
        parent::__construct($message, $code, $previous);
    }
}
