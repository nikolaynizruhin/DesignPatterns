<?php

/**
 * Comment Plugin
 */
class CommentPlugin extends Plugin
{
    /**
     * Render Block
     */
    public function render()
    {
        echo '<!-- Block BEGIN. ID: ' . spl_object_hash($this->block) . ', Type: ' 
            . get_class($this->block) . ', Length: ' . $this->block->getLength() . ', Plugins: ' . $this->block->getPlugins() . ' -->' 
            . $this->block . '<!-- Block END. ID: ' . spl_object_hash($this->block) . ', Type: ' 
            . get_class($this->block) . ', Length: ' . $this->block->getLength() . ', Plugins: ' . $this->block->getPlugins() . ' -->';
    }
}
