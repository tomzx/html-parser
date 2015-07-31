# HTML parser

[![License](https://poser.pugx.org/tomzx/html-parser/license.svg)](https://packagist.org/packages/tomzx/html-parser)
[![Latest Stable Version](https://poser.pugx.org/tomzx/html-parser/v/stable.svg)](https://packagist.org/packages/tomzx/html-parser)
[![Latest Unstable Version](https://poser.pugx.org/tomzx/html-parser/v/unstable.svg)](https://packagist.org/packages/tomzx/html-parser)
[![Build Status](https://img.shields.io/travis/tomzx/html-parser.svg)](https://travis-ci.org/tomzx/html-parser)
[![Code Quality](https://img.shields.io/scrutinizer/g/tomzx/html-parser.svg)](https://scrutinizer-ci.com/g/tomzx/html-parser/code-structure)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/tomzx/html-parser.svg)](https://scrutinizer-ci.com/g/tomzx/html-parser)
[![Total Downloads](https://img.shields.io/packagist/dt/tomzx/html-parser.svg)](https://packagist.org/packages/tomzx/html-parser)

An HTML parser written in PHP. Based on [nikic's PHP Parser](https://github.com/nikic/PHP-Parser).

## Getting started

`HTML parser` goal is to simplify the traversal/modification of an HTML tree using the visitor pattern.

First, you'll want to parse your HTML using the `Parser` in order to generate a data structure appropriate for the `NodeTraverser`.
Once that is done, you specify one or many visitors that implement the operation you want to apply on the HTML elements.
Then, you traverse the HTML tree structure, which will call the visitors on every element entry/exit.
Finally, you may print back the final output as a string.

```php
<?php

$code = file_get_contents('input.html');

$parser = new Parser();
$statements = $parser->parse($code);

$traverser = new NodeTraverser();
$traverser->addVisitor(new ElementStripper(['head', 'a'])); // A visitor which removes any element of a specific type

$statements = $traverser->traverse($statements);

$printer = new Printer();
$printer->output($statements);

```

## License

The code is licensed under the [MIT license](http://choosealicense.com/licenses/mit/). See [LICENSE](LICENSE).
