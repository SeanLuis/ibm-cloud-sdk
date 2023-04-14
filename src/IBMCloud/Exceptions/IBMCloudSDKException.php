<?php

namespace Sean\IbmPhpSdk\IBMCloud\Exceptions;

use Exception;

class IBMCloudSDKException extends Exception
{
    /**
     * @var mixed $response
     */
    protected mixed $response;

    /**
     * Create a new IBMCloudSDKException instance.
     *
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     * @param mixed|null $response
     *
     * @return void
     */
    public function __construct(string $message, int $code = 0, Exception $previous = null, mixed $response = null)
    {
        $this->response = $response;
        parent::__construct($message, $code, $previous);
    }

    /**
     * Get the response of the exception.
     *
     * @return mixed
     */
    public function getResponse(): mixed
    {
        return $this->response;
    }
}