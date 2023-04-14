<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use Sean\IbmPhpSdk\IBMCloud\STT\SpeechToTextParams;

interface SpeechToTextInterface
{
    public function recognize(SpeechToTextParams $params): array;
}