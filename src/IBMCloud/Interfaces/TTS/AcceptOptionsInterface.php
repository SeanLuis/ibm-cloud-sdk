<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces\TTS;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;

/**
 * Interface for TTS service accept options.
 */
interface AcceptOptionsInterface
{
    /**
     * Returns an array of all available accept options.
     *
     * @return string[] The available accept options.
     */
    public static function getAvailableAcceptOptions(): array;

    /**
     * Comprueba si la opción proporcionada es válida.
     *
     * @param string $option The option to check.
     *
     * @return bool True if the option is valid; false otherwise.
     */
    public static function isValidOption(string $option): bool;

    /**
     * Throws an exception if the provided option is invalid.
     *
     * @param string $option The option to check.
     *
     * @throws TextToSpeechException If the option is not valid.
     */
     public static function validateOption(string $option): void;
}