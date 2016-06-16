<?php

require __DIR__ . '/vendor/autoload.php';

// Add Border Decorator
$comment = new BorderDecorator(new CommentDecorator(new Text), 1, 'red');
$comment->render();

$text = new Text;
$text2 = new Text;
$text3 = new Text;
$image = new Image;
$image2 = new Image;
$button = new Button;
$button2 = new Button;

// Add nodes
$text->add($image, 'namespace1');
$text->add($button, 'namespace2');
$image->add($text2, 'namespace3');
$text2->add($button2, 'namespace4');
$text2->add($image2, 'namespace5');

// Render Composition
$button->renderComposition('namespace1');
echo '<br>';

// Show tree of composition
Block::displayComposite($text);

// DFS
$text->depthFirstSearch();

// BFS
$text->breadthFirstSearch();

// Create Comment Plugin
$commentPlugin = new CommentPlugin($text);

// Set Comment Plugin
$text->setPlugin($commentPlugin);

// Render method with Comment Plugin
$text->render();

// Create Add Block Plugin
$addPlugin = new AddPlugin($text);

// Set Add Block Plugin
$text->setPlugin($addPlugin);

// Add method with Add Block Plugin
$text->add($text3, 'begin');

// Add Prefix and Postfix
$text->addPrefixAndPostfix('prefix ', ' postfix');
echo '<br>' . $text;
