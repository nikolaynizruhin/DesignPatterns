<?php

/**
 * Abstract Class Block
 */
abstract class Block implements RecursiveIterator
{
    /**
     * Block`s Children
     *
     * @array
     */
    protected $children = [];

    /**
     * Parent Node
     *
     * @object Block
     */
    protected $parent;

    /**
     * Connected Plugins
     *
     * @array
     */
    protected $plugins = [];

    /**
     * Set Plugin
     *
     * @param Object $plugin
     */
    public function setPlugin($plugin)
    {
        $this->plugins[] = $plugin;
    }

    /**
     * Get Plugins
     *
     * @return String
     */
    public function getPlugins()
    {
        $plugins = '';
        foreach ($this->plugins as $plugin) {
            $plugins .= get_class($plugin) . ' ';
        }
        return $plugins;
    }

    /**
     * Get Block Length
     *
     * @return Int
     */
    public function getLength()
    {
        return strlen($this->content);
    }

    /**
     * Add Prefix and Postfix to Block
     *
     * @param String $prefix
     * @param String $postfix
     */
    public function addPrefixAndPostfix($prefix, $postfix)
    {
        $this->content = $prefix . $this->content . $postfix;
    }

    /**
     * Render Block
     */
    public function render()
    {
        if ($this->plugins) {
            foreach ($this->plugins as $plugin) {
                if (get_class($plugin) == 'CommentPlugin') {
                    $plugin->render();
                    return;
                }
            }
        } else {
            echo $this;
        }
    }

    /**
     * Convert Block to String
     * 
     * @return String
     */
    public function __toString()
    {
        return $this->content;
    }

    /**
     * Add Node
     *
     * @param Block $block
     * @param String $namespace
     */
    public function add($block, $namespace)
    {
        if ($this->plugins) {
            foreach ($this->plugins as $plugin) {
                if (get_class($plugin) == 'AddPlugin') {
                    $plugin->add($block, $namespace);
                }
            }
        } else {
            $this->children[$namespace] = $block;
            $block->parent = $this;
        }
    }

    /**
     * Get Parent Node
     *
     * @return Block
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Render Parent Node
     *
     * @param String $placeholderName
     */
    public function renderComposition($placeholderName)
    {
        $this->parent->renderPlaceholder($placeholderName);
    }

    /**
     * Render Child by Placeholder
     *
     * @param String $placeholderName
     */
    public function renderPlaceholder($placeholderName)
    {
        $this->children[$placeholderName]->render();
    }

    /**
     * Display Composite Of Nodes
     */
    static function displayComposite($block, $level = 0)
    {
        static $i = 1;
        
        foreach ($block->children as $key => $child) {
            echo str_repeat('&nbsp;&nbsp;', $level) . $i . " - " . $child->content . "<br>";
            $i++;
            if ($child->children) {
                self::displayComposite($child, $level + 1);
            }
        }
    }

    /**
     * Depth-First Search
     */
    public function depthFirstSearch()
    {
        foreach (new RecursiveIteratorIterator($this, RecursiveIteratorIterator::SELF_FIRST) as $namespace => $block) {
            echo $namespace . ' => ' . $block . '<br>';
        }
    }

    /**
     * Breadth-First Search
     */
    public function breadthFirstSearch()
    {
        $visited = [];
        $queue = [];
        array_push($visited, $this);
        array_push($queue, $this);
        echo '1. ' . $this . '<br>';
        $i = 2;
        while (count($queue)) {
            $current = array_shift($queue);
            $current = $current->children;
            foreach ($current as $key => $value) {
                echo $i . '. ' . $value . '<br>';
                if (!in_array($value, $visited)) {
                    array_push($queue, $value);
                    array_push($visited, $value);
                    $i++;
                }
            }
        }
    }

    /**
     * Has Children Validation
     *
     * @return Boolean
     */
    public function hasChildren() {
        return !empty($this->current()->children);
    }

    /**
     * Get Children
     *
     * @return Array
     */
    public function getChildren() {
        return $this->children[$this->key()];
    }

    /**
     * Reset Children
     */
    public function rewind()
    {
        reset($this->children);
    }

    /**
     * Get Current Block
     * 
     * @return Block
     */
    public function current()
    {
        return current($this->children);
    }

    /**
     * Get Key
     * 
     * @return String
     */
    public function key()
    {
        return key($this->children);
    }

    /**
     * Set Next Block
     * 
     * @return Block
     */
    public function next()
    {
        return next($this->children);
    }

    /**
     * Validate Block
     * 
     * @return Block
     */
    public function valid()
    {
        $namespace = key($this->children);
        $block = ($namespace !== NULL && $namespace !== FALSE);
        return $block;
    }
}
