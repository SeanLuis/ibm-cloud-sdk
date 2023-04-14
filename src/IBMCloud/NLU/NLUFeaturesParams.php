<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU;

use InvalidArgumentException;
use Sean\IbmPhpSdk\IBMCloud\Helpers\NLUFeaturesParamsHelper;

/**
 * Class NLUFeaturesParams
 *
 * A class representing the features to use for a Natural Language Understanding analysis.
 */
class NLUFeaturesParams
{
    private array $features;

    /**
     * NLUFeaturesParams constructor.
     *
     * @param array $features An array of features to use for the analysis.
     * @throws InvalidArgumentException If any of the provided features or options is invalid.
     */
    public function __construct(array $features = [])
    {
        $this->features = NLUFeaturesParamsHelper::verifyFeatures($features);
    }

    /**
     * Sets the value of an option for a feature.
     *
     * @param string $featureName The name of the feature.
     * @param string $optionName The name of the option.
     * @param mixed $optionValue The value to set for the option.
     * @throws InvalidArgumentException If any of the provided feature or option names or values is invalid.
     */
    public function setOption(string $featureName, string $optionName, mixed $optionValue): void
    {
        NLUFeaturesParamsHelper::isValidOptionValue($featureName, $optionName, $optionValue);
        $this->features[$featureName][$optionName] = $optionValue;
    }

    /**
     * Returns the array of features.
     *
     * @return array The array of features.
     */
    public function getFeatures(): array
    {
        return $this->features;
    }
}
