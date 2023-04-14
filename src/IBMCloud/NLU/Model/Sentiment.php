<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU\Model;

/**
 * Class Sentiment
 *
 * Represents the configuration options for the "Sentiment" feature of IBM Watson Natural Language Understanding.
 */
class Sentiment {
    /**
     * Whether to analyze the sentiment for the document.
     *
     * @var bool
     */
    public ?bool $document;

    /**
     * Whether to analyze the sentiment for targets.
     *
     * @var bool
     */
    public ?bool $targets;

    /**
     * Whether to use the label from the document level analysis for the whole document.
     *
     * @var bool
     */
    public ?bool $document_label;

    /**
     * Initializes a new instance of the Sentiment class.
     */
    public function __construct(?bool $document = false, ?bool $targets = false, ?bool $document_label = false) {
        $this->document = $document;
        $this->targets = $targets;
        $this->document_label = $document_label;
    }
}
