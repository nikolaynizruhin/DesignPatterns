<?php

/**
 * Class CommentDecorator
 */
class CommentDecorator extends Decorator
{
    /**
     * Render Comment Decorator
     */
    public function render()
    {
        echo '<!-- Block BEGIN. Type: ' . get_class($this->block) . ', ID: ' . spl_object_hash($this->block) . ', Length: ' 
        . $this->block->getLength() . ' -->';
        $this->block->render();
        echo '<!-- Block END. Type: ' . get_class($this->block) . ', ID: ' . spl_object_hash($this->block) . ' -->';
    }
}
