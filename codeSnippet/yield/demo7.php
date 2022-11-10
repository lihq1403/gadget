<?php

function yield_func(): Generator
{
    $data = yield 'yield';
    echo "get yield data: {$data}".PHP_EOL;
    yield $data * 2;
    return 'a';
}

$gen = yield_func();
$re = $gen->current();
$gen->send(32);
var_dump($gen->current());