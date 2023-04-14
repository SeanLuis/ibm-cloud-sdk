<?php

namespace Exceptions;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\IBMCloudSDKException;
use PHPUnit\Framework\TestCase;

class IBMCloudSDKExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $exception = new IBMCloudSDKException('Error in IBM Cloud SDK');
        $this->assertEquals('Error in IBM Cloud SDK', $exception->getMessage());
    }
}
