<?php

namespace TTS;

use PHPUnit\Framework\TestCase;
use Sean\IbmPhpSdk\IBMCloud\Auth\IamAuthenticator;
use Sean\IbmPhpSdk\IBMCloud\Helpers\Config;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\AcceptOptions;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\VoiceOptions;
use Sean\IbmPhpSdk\IBMCloud\TTS\TextToSpeech;

class TextToSpeechTest extends TestCase
{
    private TextToSpeech $textToSpeech;

    private string $token;

    protected function setUp(): void
    {
        // Load IBM Cloud credentials from a YAML file
        $credentials = Config::getCredentials('ibm-cloud.yaml');

        $authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

        $token = $authenticator->getAccessToken();
        $this->token = $token;

        $this->textToSpeech = new TextToSpeech(
            $token,
            $credentials['tts']['url']
        );
    }

    public function testSynthesize()
    {
        $text = 'Esto es un ejemplo de audio.';
        $voice = VoiceOptions::EN_US_ALLISON_V3_VOICE;
        $accept = AcceptOptions::AUDIO_MP3;

        $audio = $this->textToSpeech->synthesize($text, $accept, $voice);
        file_put_contents(__DIR__ . '\audio.mp3', $audio);

        $this->assertNotNull($audio);
    }
}