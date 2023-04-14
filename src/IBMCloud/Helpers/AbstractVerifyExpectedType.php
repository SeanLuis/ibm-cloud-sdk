<?php

namespace Sean\IbmPhpSdk\IBMCloud\Helpers;

abstract class AbstractVerifyExpectedType
{
    protected static function verifyExpectedType(array $validOptions, string $optionName, mixed $optionValue): bool
    {
        $expectedType = $validOptions[$optionName];
        $actualType = gettype($optionValue);

        if ($expectedType === 'bool' && $actualType !== 'boolean') {
            return false;
        } elseif ($expectedType === 'int' && $actualType !== 'integer') {
            return false;
        } elseif ($expectedType === 'float' && $actualType !== 'double') {
            return false;
        } elseif ($expectedType === 'array' && $actualType !== 'array') {
            return false;
        } elseif ($expectedType === 'string' && $actualType !== 'string') {
            return false;
        }

        return true;
    }
}