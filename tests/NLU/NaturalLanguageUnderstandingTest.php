<?php

namespace NLU;

use Exception;
use PHPUnit\Framework\TestCase;
use Sean\IbmPhpSdk\IBMCloud\Helpers\Config;
use Sean\IbmPhpSdk\IBMCloud\NLU\AnalysisFeature;
use Sean\IbmPhpSdk\IBMCloud\NLU\Model\Categories;
use Sean\IbmPhpSdk\IBMCloud\NLU\Model\Emotion;
use Sean\IbmPhpSdk\IBMCloud\NLU\Model\Keywords;
use Sean\IbmPhpSdk\IBMCloud\NLU\NaturalLanguageUnderstanding;
use Sean\IbmPhpSdk\IBMCloud\NLU\NLUFeaturesParams;

class NaturalLanguageUnderstandingTest extends TestCase
{
    private $nlu;

    public function setUp(): void
    {
        // Upload IBM Cloud credentials from a YAML file or ENV file
        $credentials = Config::getCredentials('ibm-cloud.yaml');

        $apiKey = $credentials['nlu']['api_key'];
        $url = $credentials['nlu']['url'];
        $version = '2022-04-07';
        $this->nlu = new NaturalLanguageUnderstanding($apiKey, $url, $version);
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
