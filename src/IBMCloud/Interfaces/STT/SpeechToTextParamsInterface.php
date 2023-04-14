<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces\STT;

use InvalidArgumentException;

/**
 * Interface SpeechToTextParamsInterface
 *
 * This interface defines the parameters that can be sent in the speech recognition query (SpeechToText)
 */
interface SpeechToTextParamsInterface
{
    /**
     * Constructs a new instance of the SpeechToTextParams class.
     *
     * @param array $params An optional array of parameters to set for the SpeechToText API.
     */
    public function __construct(array $params = []);

    /**
     * Sets a parameter for the SpeechToText API.
     *
     * @param string $paramName The name of the parameter to set.
     * @param mixed $paramValue The value to set for the parameter.
     * @throws InvalidArgumentException If the provided parameter name is invalid or if the provided parameter value
     *                                  is invalid for the specified parameter name.
     */
    public function setParam(string $paramName, mixed $paramValue): void;

    /**
     * Returns the parameters for the SpeechToText API.
     *
     * @return array The parameters for the SpeechToText API.
     */
    public function getParams(): array;
}
