<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU;

use Sean\IbmPhpSdk\IBMCloud\Core\BaseService;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\IBMCloudSDKException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\NaturalLanguageUnderstandingInterface;

/**
 * Class for interacting with IBM Cloud Natural Language Understanding (NLU) service.
 */
class NaturalLanguageUnderstanding extends BaseService implements NaturalLanguageUnderstandingInterface
{
    /**
     * The IBM Cloud Natural Language Understanding service name.
     */
    const SERVICE_NAME = 'nlu';

    /**
     * Constructor for NaturalLanguageUnderstandingInterface.
     *
     * @param string $token IBM Cloud API token.
     * @param string $url IBM Cloud service URL.
     * @param string $version IBM Cloud service version.
     */
    public function __construct(string $token, string $url, string $version)
    {
        parent::__construct(self::SERVICE_NAME, $url, $version);
        $this->headers['Authorization'] = 'Bearer ' . $token;
    }

    /**
     * @inheritDoc
     */
    public function analyze(string $text, NLUFeaturesParams $features): mixed
    {
        $path = '/v1/analyze';
        $data = [
            'text' => $text,
            'features' => $features->getFeatures(),
        ];

        try {
            $response = $this->sendRequest('POST', 'nlu', $path, [
                'json' => $data,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ...$this->headers
                ]
            ]);
            return $this->getBody($response, 'nlu');
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function listModels(): mixed
    {
        $path = '/v1/models';

        try {
            $response = $this->sendRequest('GET', 'nlu', $path, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ...$this->headers
                ]
            ]);
            return $this->getBody($response, 'nlu');
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }
}