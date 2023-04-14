<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;

/**
 * Interface for Watson Text to Speech service.
 */
interface TextToSpeechInterface
{
    /**
     * Synthesize audio from text using the Text to Speech service.
     *
     * @param string $text The text to synthesize audio from.
     * @param string $voice The voice to use for the audio. Acceptable values can be found in the VoiceOptionsEnum class.
     * @param string $accept The audio format to return. Acceptable values can be found in the AcceptOptionsEnum class.
     *
     * @return string The synthesized audio in the requested format.
     *
     * @throws TextToSpeechException If there is an error with the API request or invalid options are provided.
     */
    public function synthesize(string $text, string $accept, string $voice, int $rate = null): mixed;
}