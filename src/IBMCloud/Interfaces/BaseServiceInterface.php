<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use Exception;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\IBMCloudSDKException;
use Psr\Http\Message\ResponseInterface;

/**
 * Interface for IBM Watson services.
 */
interface BaseServiceInterface
{
    /**
     * Sets the API key to use for authentication.
     *
     * @param string $apiKey The API key to use.
     * @return void
     */
    public function setApiKey(string $apiKey): void;

    /**
     * Sets the version of the IBM service API to use.
     *
     * @param string $version The version to use.
     * @return void
     */
    public function setVersion(string $version): void;

    /**
     * Sends a request to the IBM service API.
     *
     * @param string $method The HTTP method to use.
     * @param string $resource The IBM service resource to access.
     * @param string|null $path The path of the IBM service resource to access.
     * @param array $options The request options to use.
     * @return ResponseInterface The response from the IBM service API.
     * @throws IBMCloudSDKException
     */
    public function sendRequest(string $method, string $resource, string $path = null, array $options = []): ResponseInterface;

    /**
     * Returns the URL for the IBM service API.
     *
     * @param string|null $path The path of the IBM service resource to access.
     * @param array|null $params The query parameters to use in the URL.
     * @return string The URL for the IBM service API.
     * @throws Exception If the service is not available.
     */
    public function getUrl(?string $path, ?array $params = []): string;

    /**
     * Gets the body of the response from the IBM service API.
     *
     * @param ResponseInterface $response The response from the IBM service API.
     * @param string $resource The IBM service resource that was accessed.
     * @return mixed The body of the response from the IBM service API.
     * @throws Exception If the resource is not supported.
     */
    public function getBody(ResponseInterface $response, string $resource): mixed;
}