<?php

namespace Exceptions;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\SpeechToTextException;
use PHPUnit\Framework\TestCase;

class SpeechToTextExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $exception = new SpeechToTextException('Error in Speech to Text API');
        $this->assertEquals('Error in Speech to Text API', $exception->getMessage());
    }
}

