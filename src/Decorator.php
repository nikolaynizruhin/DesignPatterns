<?php

/**
 * Class Decorator
 */
abstract class Decorator
{
    /**
     * Block
     *
     * @var
     */
    protected $block;

    /**
     * Decorator constructor
     *
     * @param Block $block
     */
    function __construct($block)
    {
        $this->block = $block;
    }
}
