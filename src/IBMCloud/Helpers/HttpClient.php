<?php

namespace Sean\IbmPhpSdk\IBMCloud\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\AuthenticationException;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\HttpException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\HttpClientInterface;

/**
 * The `HttpClient` class provides a simple interface for sending HTTP requests using the GuzzleHttp client.
 * It supports sending GET, POST, PUT and DELETE requests and throws exceptions for errors or authentication failures.
 */
class HttpClient implements HttpClientInterface
{
    /**
     * The GuzzleHttp client instance used for sending HTTP requests.
     *
     * @var Client $client
     */
    private Client $client;

    /**
     * Constructs a new instance of HttpClient.
     *
     * @param string $baseUri The base URI of the HTTP client.
     */
    public function __construct(string $baseUri)
    {
        $this->client = new Client([
            'base_uri' => $baseUri,
            'timeout' => 30
        ]);
    }

    /**
     * @inheritDoc
     */
    public function post(string $endpoint, array $options = []): array
    {
        try {
            $response = $this->client->request('POST', $endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException|GuzzleException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 401) {
                throw new AuthenticationException('Error de autenticación: '.$e->getMessage(), 0, $e);
            }

            throw new HttpException('Error en la solicitud HTTP: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function get(string $endpoint, array $options = []): array
    {
        try {
            $response = $this->client->get($endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 401) {
                throw new AuthenticationException('Error de autenticación: '.$e->getMessage(), 0, $e);
            }

            throw new HttpException('Error en la solicitud HTTP: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function put(string $endpoint, array $options = []): array
    {
        try {
            $response = $this->client->put($endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 401) {
                throw new AuthenticationException('Error de autenticación: '.$e->getMessage(), 0, $e);
            }

            throw new HttpException('Error en la solicitud HTTP: '.$e->getMessage(), 0, $e);
        }
    }

    /**
     * @inheritDoc
     */
    public function delete(string $endpoint, array $options = []): array
    {
        try {
            $response = $this->client->delete($endpoint, $options);
            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            if ($e->getResponse() && $e->getResponse()->getStatusCode() == 401) {
                throw new AuthenticationException('Error de autenticación: '.$e->getMessage(), 0, $e);
            }

            throw new HttpException('Error en la solicitud HTTP: '.$e->getMessage(), 0, $e);
        }
    }
}