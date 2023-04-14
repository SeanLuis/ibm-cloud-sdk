<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use InvalidArgumentException;

interface MultipartHelperInterface
{
    /**
     * Generate multipart array from an associative array of parameters
     *
     * @param array $params An associative array of parameters to send in the multipart request
     * @return array The parameters formatted in multipart array
     * @throws InvalidArgumentException if one of the parameters is invalid
     */
    public static function generateMultipartArray(array $params): array;
}