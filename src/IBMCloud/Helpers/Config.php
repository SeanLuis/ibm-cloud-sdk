<?php

namespace Sean\IbmPhpSdk\IBMCloud\Helpers;

use Sean\IbmPhpSdk\IBMCloud\Interfaces\ConfigInterface;
use Symfony\Component\Yaml\Yaml;

/**
 * Class Config
 *
 * A utility class to handle IBM Cloud SDK configuration.
 */
class Config implements ConfigInterface
{
    /**
     * The IBM Cloud API credentials.
     *
     * @var array $credentials An array containing the IBM Cloud API credentials.
     */
    private array $credentials;

    /**
     * Config constructor.
     */
    public function __construct()
    {
        $this->credentials = $this->getCredentials();
    }

    /**
     * @inheritDoc
     */
    public static function getCredentials(): array
    {
        // Find the YAML file dynamically, starting from the project root
        $yamlFile = self::findFileUpwards('ibm-cloud.yaml');
        if (!$yamlFile) {
            // If YAML file not found, load credentials from environment variables
            return [
                'ibm' => [
                    'api_key' => getenv('IBM_CLOUD_API_KEY'),
                    'url' => getenv('IBM_CLOUD_URL')
                ],
                'nlu' => [
                    'api_key' => getenv('IBM_NLU_API_KEY'),
                    'url' => getenv('IBM_NLU_URL'),
                    'version' => getenv('IBM_NLU_VERSION')
                ],
                'cos' => [
                    'api_key' => getenv('IBM_COS_API_KEY'),
                    'url' => getenv('IBM_COS_URL'),
                    'region' => getenv('IBM_COS_REGION'),
                    'bucket' => getenv('IBM_COS_BUCKET'),
                    'instance_id' => getenv('IBM_COS_INSTANCE_ID')
                ],
                'tts' => [
                    'api_key' => getenv('IBM_TTS_API_KEY'),
                    'url' => getenv('IBM_TTS_URL'),
                    'version' => getenv('IBM_TTS_VERSION')
                ],
                'stt' => [
                    'api_key' => getenv('IBM_STT_API_KEY'),
                    'url' => getenv('IBM_STT_URL'),
                    'version' => getenv('IBM_STT_VERSION')
                ]
            ];
        } else {
            // Load credentials from YAML file
            return Yaml::parseFile($yamlFile);
        }
    }

    /**
     * Find file upwards in directory hierarchy.
     *
     * @param string $filename
     * @return string|null
     */
    protected static function findFileUpwards(string $filename): ?string
    {
        $dir = __DIR__;
        while (true) {
            $file = "$dir/$filename";
            if (file_exists($file)) {
                return $file;
            }
            if ($dir === dirname($dir)) {
                break;
            }
            $dir = dirname($dir);
        }
        return null;
    }
}
