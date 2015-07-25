<?php

namespace tomzx\HtmlParser;

use DOMDocument;
use DOMNode;

class Printer
{
    public function output(array $statements)
    {
        $document = new \DOMDocument();
        $document->formatOutput = true;

        $this->import($document, $document, $statements);

        echo $document->saveHTML();
    }

    protected function import(DOMDocument $document, DomNode $node, array $statements)
    {
        /** @var Node $statement */
        foreach ($statements as $statement) {
            $newNode = $statement->getNode()->cloneNode(false);

            $newNode = $document->importNode($newNode);
            $newNode = $node->appendChild($newNode);
            if ($statement->hasChildren()) {
                $this->import($document, $newNode, $statement->getChildren());
            }
        }
    }
}
