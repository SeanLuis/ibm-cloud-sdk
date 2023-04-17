<?php

namespace Sean\IbmPhpSdk\IBMCloud\Interfaces;

use Exception;
use Sean\IbmPhpSdk\IBMCloud\NLU\NLUFeaturesParams;

/**
 * Interface for IBM Cloud Natural Language Understanding (NLU) service.
 */
interface NaturalLanguageUnderstandingInterface
{
    /**
     * Constructor for NaturalLanguageUnderstandingInterface.
     *
     * @param string $token IBM Cloud API token.
     * @param string $url IBM Cloud service URL.
     * @param string $version IBM Cloud service version.
     */
    public function __construct(string $token, string $url, string $version);

    /**
     * Analyze text using IBM Cloud Natural Language Understanding service.
     *
     * @param string $text The text to be analyzed.
     * @param NLUFeaturesParams $features The features to be analyzed.
     * @return mixed The analysis results.
     * @throws Exception
     */
    public function analyze(string $text, NLUFeaturesParams $features): mixed;

    /**
     * List available models for IBM Cloud Natural Language Understanding service.
     *
     * @return mixed The available models.
     */
    public function listModels(): mixed;
}