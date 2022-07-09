<?php

class Test
{
    public function __construct(public readonly string $prop)
    {
    }
}

$test = new Test('123');
var_dump($test->prop); // string(3) "123"
// $test->prop = 456;// Fatal error: Uncaught Error: Cannot modify readonly property Test::$prop