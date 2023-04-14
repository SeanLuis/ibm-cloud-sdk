<?php

namespace Sean\IbmPhpSdk\IBMCloud\Helpers;

use InvalidArgumentException;
use Sean\IbmPhpSdk\IBMCloud\Interfaces\NLU\NLUFeaturesParamsHelperInterface;

/**
 * Class NLUFeaturesOptionsHelper
 *
 * A helper class that provides a set of functions to manage the features options that can be sent to Natural Language Understanding API.
 */
class NLUFeaturesParamsHelper extends AbstractVerifyExpectedType implements NLUFeaturesParamsHelperInterface
{
    /**
     * @inheritDoc
     */
    public static function getValidFeatures(): array
    {
        return [
            'categories' => [
                'explanation' => 'bool',
                'limit' => 'int'
            ],
            'concepts' => [
                'limit' => 'int'
            ],
            'entities' => [
                'emotion' => 'bool',
                'limit' => 'int',
                'sentiment' => 'bool'
            ],
            'keywords' => [
                'emotion' => 'bool',
                'limit' => 'int',
                'sentiment' => 'bool'
            ],
            'metadata' => [],
            'relations' => [],
            'semantic_roles' => [
                'limit' => 'int',
                'keywords' => 'bool',
                'entities' => 'bool'
            ],
            'sentiment' => [
                'document' => 'bool',
                'targets' => 'bool',
                'document_label' => 'bool'
            ],
            'syntax' => [
                'tokens' => [
                    'lemma' => 'bool',
                    'part_of_speech' => 'bool'
                ]
            ]
        ];
    }

    /**
     * @inheritDoc
     */
    public static function verifyFeatures(array $features): array
    {
        $validFeatures = self::getValidFeatures();
        $validFeaturesKeys = array_keys($validFeatures);

        foreach ($features as $key => $value) {
            if (!in_array($key, $validFeaturesKeys)) {
                throw new InvalidArgumentException("Invalid feature: $key.");
            }

            if (is_array($value)) {
                foreach ($value as $option => $optionValue) {
                    if (!isset($validFeatures[$key][$option])) {
                        throw new InvalidArgumentException("Invalid option for feature '$key': $option.");
                    }

                    $expectedType = $validFeatures[$key][$option];
                    $actualType = gettype($optionValue);

                    if ($expectedType === 'bool' && $actualType !== 'boolean') {
                        throw new InvalidArgumentException("Invalid type for option '$option' of feature '$key'. Expected boolean, got $actualType.");
                    } elseif ($expectedType === 'int' && $actualType !== 'integer') {
                        throw new InvalidArgumentException("Invalid type for option '$option' of feature '$key'. Expected integer, got $actualType.");
                    }
                }
            }
        }

        return $features;
    }

    /**
     * @inheritDoc
     */
    public static function isValidFeature(string $featureName): bool
    {
        return array_key_exists($featureName, self::getValidFeatures());
    }

    /**
     * @inheritDoc
     */
    public static function isValidOptionValue(string $featureName, string $optionName, mixed $optionValue): void
    {
        if (!self::isValidFeature($featureName)) {
            throw new InvalidArgumentException("Invalid feature name: $featureName.");
        }

        $validOptions = self::getValidFeatures()[$featureName];

        if (!in_array($optionName, array_keys($validOptions))) {
            throw new InvalidArgumentException("Invalid option name: $optionName for feature: $featureName.");
        }

        if (!self::verifyExpectedType($validOptions, $optionName, $optionValue)) {
            throw new InvalidArgumentException("Invalid option value: $optionValue with option name: $optionName for feature: $featureName.");
        }
    }

    /**
     * @inheritDoc
     */
    public static function verifyOptions(string $featureName, array $options): void
    {
        if (!self::isValidFeature($featureName)) {
            throw new InvalidArgumentException("Invalid feature name: $featureName.");
        }

        $validOptions = self::getValidFeatures()[$featureName];
        $validOptionsKeys = array_keys($validOptions);

        foreach ($options as $key => $value) {
            if (!in_array($key, $validOptionsKeys)) {
                throw new InvalidArgumentException("Invalid option: $key for feature: $featureName.");
            }

            self::isValidOptionValue($featureName, $key, $value);
        }
    }

    /**
     * @inheritDoc
     */
    public static function getDefaultOptions(string $featureName): array
    {
        if (!self::isValidFeature($featureName)) {
            throw new InvalidArgumentException("Invalid feature name: $featureName.");
        }

        return self::getValidFeatures()[$featureName];
    }
}
