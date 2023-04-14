<?php

namespace Sean\IbmPhpSdk\IBMCloud\Exceptions;

use Throwable;

/**
 * Exception class for Speech to Text service.
 */
class SpeechToTextException extends \Exception
{
    /**
     * SpeechToTextException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}