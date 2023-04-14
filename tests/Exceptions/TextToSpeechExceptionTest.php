<?php

namespace Exceptions;

use Sean\IbmPhpSdk\IBMCloud\Exceptions\TextToSpeechException;
use PHPUnit\Framework\TestCase;

class TextToSpeechExceptionTest extends TestCase
{
    public function testExceptionMessage(): void
    {
        $exception = new TextToSpeechException('Error in Text to Speech API');
        $this->assertEquals('Error in Text to Speech API', $exception->getMessage());
    }
}

