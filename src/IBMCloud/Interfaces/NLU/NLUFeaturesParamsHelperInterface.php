<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces\NLU;

use InvalidArgumentException;

/**
 * Class NLUFeaturesOptionsHelper
 *
 * A helper class that provides a set of functions to manage the features options that can be sent to Natural Language Understanding API.
 */
interface NLUFeaturesParamsHelperInterface
{
    /**
     * Returns an array of valid features for the Natural Language Understanding API.
     *
     * @return array The array of valid features.
     */
    public static function getValidFeatures(): array;

    /**
     * Verifies the provided features array and returns a new array with only the valid features and their options.
     *
     * @param array $features The features array to verify.
     * @return array The array of valid features.
     * @throws InvalidArgumentException If any of the provided features or their options is invalid.
     */
    public static function verifyFeatures(array $features): array;

    /**
     * Checks if the provided feature is valid.
     *
     * @param string $featureName The name of the feature to check.
     * @return bool Whether the feature is valid or not.
     */
    public static function isValidFeature(string $featureName): bool;

    /**
     * Checks if the provided option value is valid for the given feature and option.
     *
     * @param string $featureName The name of the feature.
     * @param string $optionName The name of the option.
     * @param mixed $optionValue The value of the option.
     * @return void True if the option value is valid, false otherwise.
     * @throws InvalidArgumentException If the provided feature name or option name is invalid.
     */
    public static function isValidOptionValue(string $featureName, string $optionName, mixed $optionValue): void;

    /**
     * Verifies if the provided options array is valid for the given feature and its options.
     *
     * @param string $featureName The name of the feature.
     * @param array $options The options to verify.
     * @throws InvalidArgumentException If the provided feature name or option name is invalid, or if any option is invalid.
     */
    public static function verifyOptions(string $featureName, array $options): void;

    /**
     * Returns the default options for the given feature.
     *
     * @param string $featureName The name of the feature.
     * @return array The default options for the feature.
     * @throws InvalidArgumentException If the provided feature name is invalid.
     */
    public static function getDefaultOptions(string $featureName): array;
}
