<?php

/**
 * @param $foo
 * @see https:/xxxxxxxx/xxxx/xxx.html
 */
function dummy($foo)
{
    echo $foo;
}

$ref = new ReflectionFunction('dummy');
var_dump($ref);

$doc = $ref->getDocComment();
var_dump($doc);

$see = substr($doc, strpos($doc, '@see') + strlen('@see'));
var_dump($see);