<?php

namespace Sean\IbmPhpSdk\IBMCloud\TTS;

use Sean\IbmPhpSdk\IBMCloud\Core\BaseService;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\TextToSpeechInterface;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\AcceptOptions;
use Sean\IbmPhpSdk\IBMCloud\TTS\Enum\VoiceOptions;

class TextToSpeech extends BaseService implements TextToSpeechInterface
{
    /**
     * The IBM Cloud Object Storage service name.
     */
    const SERVICE_NAME = 'tts';

    public function __construct($token, $url, $version = BaseService::DEFAULT_API_VERSION, $httpClient = null)
    {
        parent::__construct(self::SERVICE_NAME, $url, $version, $httpClient);
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }

    /**
     * @inheritDoc
     */
    public function synthesize(string $text, string $accept = AcceptOptions::AUDIO_MP3, string $voice = VoiceOptions::EN_US_ALLISON_V3_VOICE, int $rate = null): string
    {
        $url = $this->url . '/v1/synthesize';
        $data = [
            'text' => $text
        ];
        $headers = [
            'Content-Type: application/json',
            'Accept: ' . $accept,
            'Authorization: ' .$this->headers['Authorization']
        ];

        // Add the voice parameter to the data array if it is not empty
        if (!empty($voice)) {
            $data['voice'] = $voice;
        }

        // Add the rate parameter to the data array if it is not 0.0
        if ($rate > 0.0) {
            $data['rate'] = $rate;
        }

        // Encode the data array to JSON
        $json_data = json_encode($data);

        // Create a new cURL handle
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new TextToSpeechException("cURL error: $error");
        }

        // Get the HTTP status code
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close the cURL handle
        curl_close($ch);

        // Check for HTTP errors
        if ($http_code !== 200) {
            throw new TextToSpeechException("HTTP error $http_code: $response");
        }

        return $response;
    }
}
