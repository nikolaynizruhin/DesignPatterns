<?php

require 'vendor/autoload.php';

use phpunit\framework\TestCase;

class TextTest extends TestCase
{
    /**
     * Set Up Text Object
     */
    public function setUp()
    {
        $this->text = new Text;
    }

    /**
     * Test Content Length
     */
    public function testContentLength()
    {
        $this->assertEquals(9, $this->text->getLength());
    }

    /**
     * Test Adding Prefix and Postfixs
     */
    public function testAddPrefixAndPostfix()
    {
        $this->text->addPrefixAndPostfix('prefix', 'postfix');
        $this->assertEquals(22, $this->text->getLength());
    }
}
