<?php

$foo = 'function foo';

function foo(): string
{
    var_dump('test function');
    return 'function foo';
}

$result = match ($foo) {
    'bar' => 'bar',
    1 => '1',
    true => true,
    foo(), 'foo' => 'function foo',
    default => 'default'
};

var_dump($result);
// string(13) "test function"
// string(12) "function foo"