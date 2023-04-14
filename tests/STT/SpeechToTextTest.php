<?php

namespace STT;

use PHPUnit\Framework\TestCase;
use Sean\IbmPhpSdk\IBMCloud\Auth\IamAuthenticator;
use Sean\IbmPhpSdk\IBMCloud\Helpers\Config;
use Sean\IbmPhpSdk\IBMCloud\STT\Enum\MultimediaModels;
use Sean\IbmPhpSdk\IBMCloud\STT\SpeechToText;
use Sean\IbmPhpSdk\IBMCloud\STT\SpeechToTextParams;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\AcceptOptions;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\VoiceOptions;

class SpeechToTextTest extends TestCase
{
    private SpeechToText $speechTotext;

    private string $token;

    protected function setUp(): void
    {
        // Load IBM Cloud credentials from a YAML file
        $credentials = Config::getCredentials('ibm-cloud.yaml');

        $authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

        $token = $authenticator->getAccessToken();
        $this->token = $token;

        $this->speechTotext = new SpeechToText(
            $token,
            $credentials['stt']['api_key'],
            $credentials['stt']['url']
        );
    }

    public function testSynthesize()
    {
        $path = __DIR__.'\audio.mp3';

        $params = new SpeechToTextParams([
            'audio' => $path,
            'content_type' => 'audio/mp3',
            'model' => MultimediaModels::SPANISH_CASTILIAN,
            'timestamps' => true,
            'word_alternatives_threshold' => 0.9,
            'keywords' => ['example', 'keyword'],
            'keywords_threshold' => 0.5
        ]);

        $transcript = $this->speechTotext->recognize($params);

        $this->assertNotNull($transcript);
        $this->assertIsArray($transcript);
        $this->assertArrayHasKey('results', $transcript);
        $this->assertIsArray($transcript['results']);

        if (count($transcript['results']) > 0) {
            $transcript = $transcript['results'][0];

            $this->assertEquals(true, $transcript['final']);
            $this->assertArrayHasKey('alternatives', $transcript);
            $this->assertIsArray($transcript['alternatives']);

            if (count($transcript['alternatives']) > 0) {
                $alternative = $transcript['alternatives'][0];
                $this->assertArrayHasKey('transcript', $alternative);
                $this->assertArrayHasKey('confidence', $alternative);
            }
        }
    }
}