<?php

namespace Sean\IbmPhpSdk\IBMCloud\Exceptions;

use Throwable;

class HttpException extends \Exception
{
    /**
     * HttpException constructor.
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