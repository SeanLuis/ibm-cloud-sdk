<?php

namespace Sean\IbmPhpSdk\IBMCloud\Core;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\IBMCloudSDKException;
use Psr\Http\Message\ResponseInterface;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\BaseServiceInterface;

/**
 * Abstract class for all service.
 */
abstract class BaseService implements BaseServiceInterface
{
    /**
     * Default API version to use if one is not specified.
     */
    const DEFAULT_API_VERSION = '2022-04-07';

    /**
     * The name of the service.
     */
    protected string $name;

    /**
     * The API key used to authenticate requests.
     */
    protected string $apiKey;

    /**
     * The base URL for the service.
     */
    protected string $url;

    /**
     * The API version to use.
     */
    protected string $version;

    /**
     * The HTTP client to use for requests.
     */
    protected Client $httpClient;

    /**
     * BaseService constructor.
     *
     * @param string $name The service name.
     * @param string $apiKey The API key to use for authentication.
     * @param string $url The URL of the IBM service.
     * @param string $version The version of the IBM service API to use.
     * @param Client|null $httpClient The HTTP client to use for requests.
     */
    public function __construct(string $name, string $apiKey, string $url, string $version = self::DEFAULT_API_VERSION, Client $httpClient = null)
    {
        $this->name = $name;
        $this->apiKey = $apiKey;
        $this->url = $url;
        $this->version = $version;
        $this->httpClient = $httpClient ?: new Client();
    }

    /**
     * @inheritDoc
     */
    public function setApiKey(string $apiKey): void
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @inheritDoc
     */
    public function setVersion(string $version): void
    {
        $this->version = $version;
    }

    /**
     * @inheritDoc
     */
    public function sendRequest(string $method, string $resource, string $path = null, array $options = []): ResponseInterface
    {
        $url = $this->getUrl($path);

        if (array_key_exists('headers', $options))
            $headers = [
                ...$options['headers']
            ];

        switch ($resource) {
            case "nlu":
            $headers['Authorization'] = 'Basic ' . base64_encode('apikey:' . $this->apiKey);
                break;
            case "cos":
            case "tts":
            case "stt":
                break;
        }

        $options = array_merge($options, [
            'headers' => $headers,
            'http_errors' => true
        ]);

        try {
            $response = $this->httpClient->request($method, $url, $options);
        } catch (GuzzleException $e) {
            throw new IBMCloudSDKException($e->getMessage(), $e->getCode(), $e);
        }

        if ($response->getStatusCode() >= 400) {
            throw new IBMCloudSDKException($response->getReasonPhrase(), $response->getStatusCode(), null, $response);
        }

        return $response;
    }

    /**
     * @inheritDoc
     */
    public function getUrl(?string $path, ?array $params = []): string
    {
        $params = http_build_query(['version' => $this->version, ...$params]);

        return match ($this->name) {
            "nlu",
            "cos",
            "stt",
            "tts" => $path
                ? $this->url . $path . '?' . $params
                : $this->url .  '?' .$params,
            default => throw new Exception('NOT_SERVICE_PROVIDE'),
        };
    }

    /**
     * @inheritDoc
     */
    public function getBody(ResponseInterface $response, string $resource): mixed
    {
        return match ($resource) {
            "nlu" => json_decode($response->getBody()->getContents(), true),
            "cos", "tts" => $response->getBody()->getContents(),
        };
    }
}