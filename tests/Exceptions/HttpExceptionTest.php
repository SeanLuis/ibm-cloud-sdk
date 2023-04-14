<?php

namespace Exceptions;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\HttpException;
use PHPUnit\Framework\TestCase;

class HttpExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $exception = new HttpException('HTTP Error 404: Page not found', 404);
        $this->assertEquals('HTTP Error 404: Page not found', $exception->getMessage());
    }

    public function testGetStatusCode(): void
    {
        $exception = new HttpException('Page not found', 404);
        $this->assertEquals(404, $exception->getCode());
    }
}