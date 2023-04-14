<?php

namespace Sean\IbmPhpSdk\IBMCloud\Exceptions;

use Throwable;

class AuthenticationException extends \Exception
{
    /**
     * AuthenticationException constructor.
     *
     * @param string         $message
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message, int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}