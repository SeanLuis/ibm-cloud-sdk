<?php

namespace Sean\IbmPhpSdk\IBMCloud\STT;

use Sean\IbmPhpSdk\IBMCloud\Core\BaseService;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\SpeechToTextException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\SpeechToTextInterface;

class SpeechToText extends BaseService implements SpeechToTextInterface
{
    const SERVICE_NAME = 'stt';

    public function __construct($token, $url, $version = BaseService::DEFAULT_API_VERSION, $httpClient = null)
    {
        parent::__construct(self::SERVICE_NAME, $url, $version, $httpClient);
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }

    public function recognize(SpeechToTextParams $params): array
    {
        $url = $this->url . '/v1/recognize';

        $params = $params->getParams();

        foreach ($params as $key => $value) {
            if (!$value) {
                unset($params[$key]);
            }
        }

        $file_content = file_get_contents($params['audio']);
        $file_size = filesize($params['audio']);

        $headers = [
            'Content-Type: '. $params['content_type'],
            'Authorization: ' .$this->headers['Authorization'],
            'Content-Length: ' . $file_size,
        ];

        // Create a new cURL handle
        $ch = curl_init();

        // Set the cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $file_content);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Execute the cURL request
        $response = curl_exec($ch);

        // Check for cURL errors
        if ($response === false) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new SpeechToTextException("cURL error: $error");
        }

        // Get the HTTP status code
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Close the cURL handle
        curl_close($ch);

        // Check for HTTP errors
        if ($http_code !== 200) {
            throw new SpeechToTextException("HTTP error $http_code: $response");
        }

        return json_decode($response, true);
    }
}