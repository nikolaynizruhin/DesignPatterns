<?php

/**
 * Plugin
 */
class Plugin extends Block
{
    /**
     * Block
     *
     * @object Block
     */
    protected $block;

    /**
     * CommentPlugin Construct
     *
     * @param Block $block
     */
    function __construct($block)
    {
        $this->block = $block;
    }
}
