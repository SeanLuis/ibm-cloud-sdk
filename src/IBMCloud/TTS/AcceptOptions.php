<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\TTS;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\TTS\AcceptOptionsInterface;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\AcceptOptions as AO;

class AcceptOptions implements AcceptOptionsInterface
{
    /**
     * @inheritDoc
     */
    public static function getAvailableAcceptOptions(): array
    {
        return AO::$availableOptions;
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
            throw new TextToSpeechException("Invalid option: " . $option);
        }
    }
}