<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\STT;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\SpeechToTextException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\STT\MultimediaModelsInterface;
use Sean\IbmPhpSdk\IBMCloud\STT\Enum\MultimediaModels as MM;

class MultimediaModels implements MultimediaModelsInterface
{
    /**
     * @inheritDoc
     */
    public static function getAvailableAcceptOptions(): array
    {
        return MM::$availableOptions;
    }

    /**
     * @inheritDoc
     */
    public static function isValidOption(string $option): bool
    {
        return in_array($option, self::getAvailableAcceptOptions());
    }

    /**
     * @inheritDoc
     */
    public static function validateOption(string $option): void
    {
        if (!self::isValidOption($option)) {
            throw new SpeechToTextException("Invalid option: " . $option);
        }
    }
}