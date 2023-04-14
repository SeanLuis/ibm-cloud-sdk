<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU\Model;

/**
 * Class Keywords
 *
 * Represents the configuration options for the "Keywords" feature of IBM Watson Natural Language Understanding.
 */
class Keywords {
    /**
     * Enable or disable sentiment analysis for each keyword.
     *
     * @var bool $sentiment Whether to enable sentiment analysis for keywords.
     */
    public ?bool $sentiment;

    /**
     * Enable or disable emotion analysis for each keyword.
     *
     * @var bool $emotion Whether to enable emotion analysis for keywords.
     */
    public ?bool $emotion;

    /**
     * The maximum number of keywords to extract.
     *
     * @var int $limit The maximum number of keywords to extract.
     */
    public ?int $limit;

    /**
     * Keywords constructor.
     *
     * Initializes the default values for the keyword configuration options.
     */
    public function __construct(?bool $sentiment = false, ?bool $emotion = false, ?int $limit = 50) {
        $this->sentiment = $sentiment;
        $this->emotion = $emotion;
        $this->limit = $limit;
    }
}