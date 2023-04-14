<?php

namespace COS;

use PHPUnit\Framework\TestCase;
use Sean\IbmPhpSdk\IBMCloud\Auth\IamAuthenticator;
use Sean\IbmPhpSdk\IBMCloud\COS\CloudObjectStorage;
use Sean\IbmPhpSdk\IBMCloud\Helpers\Config;

class CloudObjectStorageTest extends TestCase
{

    private $cos;
    private $token;
    private $bucket;

    public function setUp(): void
    {
        // Load IBM Cloud credentials from a YAML file
        $credentials = Config::getCredentials('ibm-cloud.yaml');

        $authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

        $token = $authenticator->getAccessToken();
        $this->token = $token;
        $this->bucket = $credentials['cos']['bucket'];

        // Create an instance of CloudObjectStorage
        $this->cos = new CloudObjectStorage(
            $token,
            $credentials['cos']['api_key'],
            $credentials['cos']['instance_id'],
            $credentials['cos']['url']
        );
    }

    public function testListBuckets()
    {
        $response = $this->cos->listBuckets();

        $this->assertArrayHasKey('Owner', $response);
        $this->assertArrayHasKey('ID', $response['Owner']);
        $this->assertArrayHasKey('DisplayName', $response['Owner']);
        $this->assertArrayHasKey('Buckets', $response);
        $this->assertIsArray($response['Buckets']);
        if (count($response['Buckets']) > 0) {
            $this->assertArrayHasKey('Name', $response['Buckets']['Bucket']);
        }
    }

    public function testUploadObject()
    {
        $fileName = 'test.txt';
        $fileContent = 'Este es un archivo de prueba.';
        $response = $this->cos->putObject($this->bucket, $fileName, $fileContent);

        $this->assertIsBool($response);
        $this->assertEquals(true, $response);
    }

    public function testListObjects()
    {
        $response = $this->cos->listObjects($this->bucket);

        $this->assertIsArray($response);
        $this->assertArrayHasKey('Name', $response);
        $this->assertEquals($this->bucket, $response['Name']);
        $this->assertArrayHasKey('Contents', $response);
        $this->assertIsArray($response['Contents']);
    }

    public function testGetObject()
    {
        $objectName = 'test.txt';
        $response = $this->cos->getObject($this->bucket, $objectName);

        $this->assertIsString($response);
    }

    public function testDeleteObject()
    {
        $objectName = 'test.txt';
        $response = $this->cos->deleteObject($this->bucket, $objectName);

        $this->assertIsBool($response);
        $this->assertEquals(true, $response);
    }
}