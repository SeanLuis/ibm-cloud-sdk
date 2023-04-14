<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\STT;

use InvalidArgumentException;
use Sean\IbmPhpSdk\IBMCloud\Helpers\SpeechToTextParamsHelper;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\STT\SpeechToTextParamsInterface;

/**
 * Class SpeechToTextOptions
 *
 * Represents the possible options that can be passed to a SpeechToText request.
 */
class SpeechToTextParams implements SpeechToTextParamsInterface
{
    private array $params;

    /**
     * @inheritDoc
     */
    public function __construct(array $params = [])
    {
        $this->params = SpeechToTextParamsHelper::verifyOptions($params);
    }

    /**
     * @inheritDoc
     */
    public function setParam(string $paramName, $paramValue): void
    {
        if (!SpeechToTextParamsHelper::isValidOption($paramName)) {
            throw new InvalidArgumentException("'$paramName' is not a valid option.");
        }

        SpeechToTextParamsHelper::verifyOption($paramName, $paramValue);
        $this->params[$paramName] = $paramValue;
    }

    /**
     * @inheritDoc
     */
    public function getParams(): array
    {
        return $this->params;
    }
}
