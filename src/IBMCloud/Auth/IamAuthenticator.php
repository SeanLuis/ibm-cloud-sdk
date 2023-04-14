<?php

namespace Sean\IbmPhpSdk\IBMCloud\Auth;

use GuzzleHttp\Exception\GuzzleException;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\AuthenticationException;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\HttpException;
use Sean\IbmPhpSdk\IBMCloud\Helpers\HttpClient;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\IamAuthenticatorInterface;

/**
 * Provides authentication for IBM Cloud services using an IAM API key.
 */
class IamAuthenticator implements IamAuthenticatorInterface
{
    /**
     * The IAM API key to use for authentication.
     *
     * @var string
     */
    private $apiKey;

    /**
     * The access token obtained from the IAM service.
     *
     * @var string|null
     */
    private $accessToken;

    /**
     * The HTTP client used to make requests to the IAM service.
     *
     * @var HttpClient
     */
    private $httpClient;

    /**
     * Creates a new instance of the IamAuthenticator class.
     *
     * @param string $apiKey The IAM API key to use for authentication.
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new HttpClient('https://iam.cloud.ibm.com');
    }

    /**
     * @inheritDoc
     */
    public function getAccessToken(): string
    {
        if (!$this->accessToken) {
            $this->requestAccessToken();
        }

        return $this->accessToken;
    }

    /**
     * Requests a new access token from the IAM service.
     */
    protected function requestAccessToken(): void
    {
        try {
            $response = $this->httpClient->post('/identity/token', [
                'form_params' => [
                    'grant_type' => 'urn:ibm:params:oauth:grant-type:apikey',
                    'apikey' => $this->apiKey
                ],
                'headers' => [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                    'Accept' => 'application/json'
                ]
            ]);
        } catch (AuthenticationException|HttpException $e) {
        }

        $this->accessToken = $response['access_token'];
    }
}