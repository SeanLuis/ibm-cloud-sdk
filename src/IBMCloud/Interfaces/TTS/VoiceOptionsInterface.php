<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces\TTS;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;

/**
 * Interface for TTS service voice options.
 */
interface VoiceOptionsInterface
{
    /**
     * Returns an array of all available voice options.
     *
     * @return string[] The available voice options.
     */
    public static function getAvailableVoiceOptions(): array;

    /**
     * Check if an option is valid for this set of options.
     *
     * @param string $option The option to check.
     *
     * @return bool Returns true if the option is valid, otherwise false.
     */
    public static function isValidOption(string $option): bool;

    /**
     * Validate that an option is valid for this set of options, throwing an exception if it is not.
     *
     * @param string $option The option to validate.
     *
     * @throws TextToSpeechException If the option is not valid for this set of options.
     */
    public static function validateOption(string $option): void;
}