<?php

namespace Sean\IbmPhpSdk\IBMCloud\COS;

use Sean\IbmPhpSdk\IBMCloud\Core\BaseService;
use Sean\IbmPhpSdk\IBMCloud\Exceptions\IBMCloudSDKException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\CloudObjectStorageInterface;

/**
 * Class for interacting with IBM Cloud Object Storage (COS) service.
 */
class CloudObjectStorage extends BaseService implements CloudObjectStorageInterface
{
    /**
     * The IBM Cloud Object Storage service name.
     */
    const SERVICE_NAME = 'cos';

    public function __construct($token, $apiKey, $resourceInstanceID, $url, $version = BaseService::DEFAULT_API_VERSION, $httpClient = null)
    {
        parent::__construct(self::SERVICE_NAME, $apiKey, $url, $version, $httpClient);

        $this->headers['Authorization'] = 'Bearer ' . $token;
        $this->headers['ibm-service-instance-id'] = $resourceInstanceID;
    }

    /**
     * @inheritDoc
     */
    public function createBucket(string $bucketName, string $region = null): bool
    {
        $path = '/' . $bucketName;
        $headers = [
            'ibm-cos-location-constraint' => $region ?: $this->version,
        ];

        try {
            $response = $this->sendRequest('PUT', 'cos', $path, [
                'headers' => [
                    ...$headers,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ]
            ]);
            return $response->getStatusCode() === 200;
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteBucket(string $bucketName): bool
    {
        $path = '/' . $bucketName;

        try {
            $response = $this->sendRequest('DELETE', 'cos', $path, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ...$this->headers
                ]
            ]);
            return $response->getStatusCode() === 204;
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function getObject(string $bucketName, string $objectName): string
    {
        $path = '/' . $bucketName . '/' . $objectName;

        try {
            $response = $this->sendRequest('GET', 'cos', $path, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ...$this->headers
                ]
            ]);
            return $response->getBody()->getContents();
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function copyObject(string $sourceBucket, string $sourceObject, string $destinationBucket, string $destinationObject, string $contentType = null, array $metadata = []): bool
    {
        $path = '/' . $sourceBucket . '/' . $sourceObject;

        $headers = [
            'Content-Type' => $contentType ?: 'multipart/form-data',
            'x-amz-copy-source' => "/{$sourceBucket}/{$sourceObject}"
        ];
        foreach ($metadata as $key => $value) {
            $headers['x-amz-tagging-' . strtolower($key)] = $value;
        }

        try {
            $response = $this->sendRequest('PUT', 'cos', $path, [
                'multipart' => [
                    [
                        'name' => 'Bucket',
                        'contents' => $destinationBucket,
                    ],
                    [
                        'name' => 'TargetKey',
                        'contents' => $destinationObject,
                    ]
                ],
                'headers' => [
                    ...$headers,
                    ...$this->headers
                ]
            ]);
            return $response->getStatusCode() === 200;
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function putObject(string $bucketName, string $objectName, string $body, string $contentType = null, array $metadata = []): bool
    {
        $path = '/' . $bucketName . '/' . $objectName;

        $headers = [
            'Content-Length' => strlen($body),
            'Content-Type' => $contentType ?: 'application/octet-stream',
        ];
        foreach ($metadata as $key => $value) {
            $headers['x-amz-tagging-' . strtolower($key)] = $value;
        }

        try {
            $response = $this->sendRequest('PUT', 'cos', $path, [
                'body' => $body,
                'headers' => [
                    ...$headers,
                    ...$this->headers
                ]
            ]);
            return $response->getStatusCode() === 200;
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteObject(string $bucketName, string $objectName): bool
    {
        $path = '/' . $bucketName . '/' . $objectName;

        try {
            $response = $this->sendRequest('DELETE', 'cos', $path, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ...$this->headers
                ]
            ]);
            return $response->getStatusCode() === 204;
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function listObjects(string $bucketName, string $prefix = null, string $delimiter = null): array
    {
        $path = '/' . $bucketName;

        $params = [];
        if ($prefix) {
            $params['prefix'] = $prefix;
        }
        if ($delimiter) {
            $params['delimiter'] = $delimiter;
        }

        try {
            $response = $this->sendRequest('GET', 'cos', $path, [
                'query' => $params,
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
                    ...$this->headers
                ]
            ]);
            $xml = $this->getBody($response, 'cos');

            return $this->xmlToArray($xml);
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    /**
     * @inheritDoc
     */
    public function listBuckets(): array
    {
        try {
            $response = $this->sendRequest('GET', 'cos', null, [
                'headers' => $this->headers
            ]);
            $xml = $this->getBody($response, 'cos');

            return $this->xmlToArray($xml);
        } catch (IBMCloudSDKException $ex) {
            return $ex->getMessage();
        }
    }

    private function xmlToArray($xmlString)
    {
        $xml = simplexml_load_string($xmlString);
        $json = json_encode($xml);

        return json_decode($json, true);
    }
}