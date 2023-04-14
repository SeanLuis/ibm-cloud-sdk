<?php

namespace Sean\IbmPhpSdk\IBMCloud\NLU\Model;

/**
 * Class Entities
 *
 * Represents an entity analysis feature for the NLU service.
 */
class Entities
{
    /**
     * Whether or not to enable sentiment analysis for entities.
     *
     * @var bool
     */
    public ?bool $sentiment;

    /**
     * Whether or not to enable emotion detection for entities.
     *
     * @var bool
     */
    public ?bool $emotion;

    /**
     * The maximum number of entities to return.
     *
     * @var int
     */
    public ?int $limit;

    /**
     * Constructs a new Entities instance with default values.
     */
    public function __construct(?bool $sentiment = false, ?bool $emotion = false, ?int $limit = 50)
    {
        $this->sentiment = $sentiment;
        $this->emotion = $emotion;
        $this->limit = $limit;
    }
}
