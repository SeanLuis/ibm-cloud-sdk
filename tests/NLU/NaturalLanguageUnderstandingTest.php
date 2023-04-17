<?php

namespace NLU;

use Exception;
use PHPUnit\Framework\TestCase;
use Sean\IbmPhpSdk\IBMCloud\Auth\IamAuthenticator;
use Sean\IbmPhpSdk\IBMCloud\Helpers\Config;
use Sean\IbmPhpSdk\IBMCloud\NLU\NaturalLanguageUnderstanding;
use Sean\IbmPhpSdk\IBMCloud\NLU\NLUFeaturesParams;

class NaturalLanguageUnderstandingTest extends TestCase
{
    private $nlu;
    private $token;

    public function setUp(): void
    {
        // Load IBM Cloud credentials from a YAML file
        $credentials = Config::getCredentials('ibm-cloud.yaml');

        $authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

        $token = $authenticator->getAccessToken();
        $this->token = $token;

        $url = $credentials['nlu']['url'];
        $version = '2022-04-07';

        $this->nlu = new NaturalLanguageUnderstanding($token, $url, $version);
    }

    public function testAnalyze()
    {
        $text = 'Estoy muy contento con el resultado del partido de hoy.';

        // Define your feature options for text analysis
        $options = [
            'entities' => [
                'sentiment' => true,
                'emotion' => true,
                'limit' => 10,
            ],
            'keywords' => [
                'sentiment' => true,
                'emotion' => true,
                'limit' => 10,
            ],
            'sentiment' => [
                'document' => true,
            ],
            'categories' => [
                'limit' => 5,
            ],
        ];

        // Instantiate NLUFeaturesParams with custom options
        $nluFeaturesParams = new NLUFeaturesParams($options);

        try {
            $result = $this->nlu->analyze($text, $nluFeaturesParams);
            $this->assertNotNull($result);
            $this->assertArrayHasKey('keywords', $result);
            $this->assertIsArray($result['keywords']);
            $this->assertArrayHasKey('categories', $result);
            $this->assertIsArray($result['categories']);
            $this->assertArrayHasKey('entities', $result);
            $this->assertIsArray($result['entities']);
        } catch (Exception $ex) {
            $this->fail('Error executing test: ' . $ex->getMessage());
        }
    }

    public function testListModels()
    {
        try {
            $response = $this->nlu->listModels();
            $this->assertIsArray($response);
        } catch (Exception $ex) {
            $this->fail('Error executing test: ' . $ex->getMessage());
        }
    }
}
