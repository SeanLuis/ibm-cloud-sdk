<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

/**
 * Provides authentication for IBM Cloud services using an IAM API key.
 */
interface IamAuthenticatorInterface
{
    /**
     * Returns an access token that can be used to authenticate requests to IBM Cloud services.
     *
     * @return string The access token.
     */
    public function getAccessToken(): string;
}