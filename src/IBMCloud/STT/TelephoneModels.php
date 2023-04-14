<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\STT;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\SpeechToTextException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\STT\TelephoneModelsInterface;
use Sean\IbmPhpSdk\IBMCloud\STT\Enum\TelephoneModels as TM;

class TelephoneModels implements TelephoneModelsInterface
{
    /**
     * @inheritDoc
     */
    public static function getAvailableAcceptOptions(): array
    {
        return TM::$availableOptions;
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