<?php

function yield_from_func(): Generator
{
    yield from [1, 2, 3, 4];
}

foreach (yield_from_func() as $value) {
    echo 'value is ' . $value . PHP_EOL;
}

function yield_func(): Generator
{
    yield 1;
    yield 2;
    yield 3;
    yield 4;
}

function yield_from_func2(): Generator
{
    yield from yield_func();
}

foreach (yield_from_func2() as $value) {
    echo 'value is ' . $value . PHP_EOL;
}