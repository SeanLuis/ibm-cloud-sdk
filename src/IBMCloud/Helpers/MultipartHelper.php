<?php

namespace Sean\IbmPhpSdk\IBMCloud\Helpers;

use InvalidArgumentException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\MultipartHelperInterface;

class MultipartHelper implements MultipartHelperInterface
{
    /**
     * @inheritDoc
     */
    public static function generateMultipartArray(array $params): array
    {
        $multipart = [];

        foreach ($params as $name => $value) {
            if (is_array($value) || is_object($value)) {
                $multipart[] = [
                    'name' => $name,
                    'contents' => $value,
                ];
            } elseif (is_file($value)) {
                $multipart[] = [
                    'name' => $name,
                    'contents' => fopen($value, 'r'),
                    'filename' => basename($value),
                    'headers' => [
                        'Content-Type' => 'application/json'
                    ]
                ];
            } else {
                $multipart[] = [
                    'name' => $name,
                    'contents' => (string) $value,
                ];
            }
        }

        return $multipart;
    }
}