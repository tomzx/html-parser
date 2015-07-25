<?php

namespace tomzx\HtmlParser;

use DOMNode;
use tomzx\AbstractParser\NodeInterface;

class Node implements NodeInterface
{
    protected $node;

    protected $children = [];

    public function __construct(DOMNode $node)
    {
        $this->node = $node;
        if ($this->node->hasChildNodes()) {
            foreach ($this->node->childNodes as $child) {
                $this->children[] = new Node($child);
            }
        }
    }

    public function &getChildren()
    {
//        if (!$this->node->hasChildNodes()) {
//            return [];
//        }
//
//        $children = [];
//        foreach ($this->node->childNodes as $child) {
//            $children[] = new Node($child);
//        }
//        return $children;
        return $this->children;
    }

//    public function setChild($index, NodeInterface $node)
//    {
//        $this->children[$index] = $node;
//    }

    public function hasChildren()
    {
        return $this->node->hasChildNodes();
    }

    public function getNode()
    {
        return $this->node;
    }

    public function __debugInfo()
    {
        return [
            'name' => $this->node->nodeName,
            'children' => $this->children,
        ];
    }
}
