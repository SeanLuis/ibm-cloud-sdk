<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\AuthenticationException;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\HttpException;

interface HttpClientInterface
{
    /**
     * Sends a POST request to the specified endpoint with the provided options.
     *
     * @param string $endpoint The endpoint URL to send the request to.
     * @param array $options The request options to use.
     * @return array The response body as an associative array.
     * @throws AuthenticationException if there is an authentication error.
     * @throws HttpException if there is an error with the HTTP request.
     */
    public function post(string $endpoint, array $options = []): array;

    /**
     * Sends a GET request to the specified endpoint with the provided options.
     *
     * @param string $endpoint The endpoint URL to send the request to.
     * @param array $options The request options to use.
     * @return array The response body as an associative array.
     * @throws AuthenticationException if there is an authentication error.
     * @throws HttpException if there is an error with the HTTP request.
     */
    public function get(string $endpoint, array $options = []): array;

    /**
     * Sends a PUT request to the specified endpoint with the provided options.
     *
     * @param string $endpoint The endpoint URL to send the request to.
     * @param array $options The request options to use.
     * @return array The response body as an associative array.
     * @throws AuthenticationException if there is an authentication error.
     * @throws HttpException if there is an error with the HTTP request.
     */
    public function put(string $endpoint, array $options = []): array;

    /**
     * Sends a DELETE request to the specified endpoint with the provided options.
     *
     * @param string $endpoint The endpoint URL to send the request to.
     * @param array $options The request options to use.
     * @return array The response body as an associative array.
     * @throws AuthenticationException if there is an authentication error.
     * @throws HttpException if there is an error with the HTTP request.
     */
    public function delete(string $endpoint, array $options = []): array;

}