<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU\Model;


/**
 * Class Categories
 *
 * Model representing the categories to be analyzed in Natural Language Understanding.
 */
class Categories {
    /**
     * Whether to include the explanation for each categorization result.
     *
     * @var bool
     */
    public ?bool $explanation;

    /**
     * The maximum number of categories to return.
     *
     * @var int
     */
    public ?int $limit;

    /**
     * Constructor for Categories model class.
     */
    public function __construct(?bool $explanation = false, ?int $limit = 10) {
        $this->explanation = $explanation;
        $this->limit = $limit;
    }
}