<?php

/**
 * Add Block Plugin
 */
class AddPlugin extends Plugin
{
    /**
     * Add Block
     *
     * @param Block $block
     * @param String $place
     */
    public function add($block, $place)
    {
        if ($place == 'begin') {
            array_unshift($this->block->children, $block);
            $this->block->parent = $this;
            return;
        } elseif ($place == 'end') {
            $this->block->children[] = $block;
            $this->block->parent = $this;
            return;
        }
    }
}
