<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU\Model;

/**
 * Class Emotion
 *
 * Model representing the emotions to be analyzed in Natural Language Understanding.
 */
class Emotion {
    /**
     * Flag to enable/disable emotion analysis on the overall document
     *
     * @var bool
     */
    public ?bool $document;

    /**
     * Flag to enable/disable emotion analysis on specific targets (entities, keywords)
     *
     * @var bool
     */
    public ?bool $targets;

    /**
     * Constructor for the Emotion class
     *
     * Initializes the emotion flags to false by default.
     */
    public function __construct(?bool $document = false, ?bool $targets = false)
    {
        $this->document = $document;
        $this->targets = $targets;
    }
}