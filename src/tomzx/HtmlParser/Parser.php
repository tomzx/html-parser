<?php

namespace tomzx\HtmlParser;

class Parser
{
    protected $suppressErrors = false;

    /**
     * @param string $code
     * @return \tomzx\HtmlParser\Node[]
     */
    public function parse($code)
    {
        $document = $this->createDOMDocument($code);

        if (!($root = $document->getElementsByTagName('html')->item(0))) {
            throw new \InvalidArgumentException('Invalid HTML was provided');
        }

        $rootNode = new Node($root);
        //$statements = $this->parseNode($rootNode);

        return [$rootNode]; //$statements;
    }

    /**
     * @param string $code
     * @return \DOMDocument
     */
    protected function createDOMDocument($code)
    {
        $document = new \DOMDocument();

        // TODO: Make suppress error configurable
        if ($this->suppressErrors) {
            // Suppress conversion errors (from http://bit.ly/pCCRSX)
            libxml_use_internal_errors(true);
        }

        // Hack to load utf-8 HTML (from http://bit.ly/pVDyCt)
        $document->loadHTML('<?xml encoding="UTF-8">' . $code);
        $document->encoding = 'UTF-8';

        if ($this->suppressErrors) {
            libxml_clear_errors();
        }

        return $document;
    }

    /**
     * @param \tomzx\HtmlParser\Node $node
     * @return array
     */
    protected function parseNode(Node $node)
    {
        $statements = $node->getChildren();
        foreach ($node->getChildren() as $child) {
            $statements[] = $this->parseNode($child);
        }
        return $statements;
    }
}
