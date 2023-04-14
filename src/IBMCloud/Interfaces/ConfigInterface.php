<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use Symfony\Component\Yaml\Yaml;

/**
 * Interface ConfigInterface
 *
 * A utility class to handle IBM Cloud SDK configuration.
 */
interface ConfigInterface
{
    /**
     * Get IBM Cloud credentials
     *
     * @return array IBM Cloud credentials
     */
    public static function getCredentials(): array;
}
