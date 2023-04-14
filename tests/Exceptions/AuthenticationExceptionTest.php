<?php

namespace Exceptions;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\AuthenticationException;
use PHPUnit\Framework\TestCase;

class AuthenticationExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $exception = new AuthenticationException('Invalid API key');
        $this->assertEquals('Invalid API key', $exception->getMessage());
    }
}