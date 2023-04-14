<?php

namespace Auth;

use PHPUnit\Framework\TestCase;
use Sean\IbmPhpSdk\IBMCloud\Auth\IamAuthenticator;
use Sean\IbmPhpSdk\IBMCloud\Helpers\Config;

class IamAuthenticatorTest extends TestCase
{

    public function testRequestAccessToken()
    {
        // Load IBM Cloud credentials from a YAML file
        $credentials = Config::getCredentials('ibm-cloud.yaml');

        $authenticator = new IamAuthenticator($credentials['ibm']['api_key']);

        $token = $authenticator->getAccessToken();
        $this->assertIsString($token);
    }

}