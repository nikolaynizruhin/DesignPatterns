<?php

/**
 * Class BorderDecorator
 */
class BorderDecorator extends Decorator
{
    /**
     * Block
     *
     * @var Block
     */
    protected $block;

    /**
     * Thickness Of Border
     *
     * @var int
     */
    private $thickness;

    /**
     * Color Of Border
     *
     * @var string
     */
    private $color;

    /**
     * BorderDecorator constructor
     *
     * @param Block $block
     * @param int $thickness
     * @param string $color
     */
    function __construct($block, $thickness, $color)
    {
        $this->block = $block;
        $this->thickness = $thickness;
        $this->color = $color;
    }

    /**
     * Render Border Decorator
     */
    public function render()
    {
        echo '<div style="border: ' . $this->thickness . 'px solid ' . $this->color . ';">';
        $this->block->render();
        echo '</div>';
    }
}
