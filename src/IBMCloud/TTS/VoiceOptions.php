<?php

declare(strict_types=1);

namespace Sean\IbmPhpSdk\IBMCloud\TTS;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\TTS\VoiceOptionsInterface;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\VoiceOptions as VO;

class VoiceOptions implements VoiceOptionsInterface
{
    /**
     * @inheritDoc
     */
    public static function getAvailableVoiceOptions(): array
    {
        return VO::$availableOptions;
    }

    /**
     * @inheritDoc
     */
    public static function isValidOption(string $option): bool
    {
        return in_array($option, self::getAvailableVoiceOptions());
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