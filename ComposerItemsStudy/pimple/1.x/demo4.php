<?php

require __DIR__ . '/vendor/autoload.php';

$container = new Pimple();

$container['bar'] = function () {
    return 'bar';
};

$container['foo'] = $container->protect(function () {
    return 'foo';
});

var_dump($container['bar']); // string(3) "bar"
var_dump($container['foo']); // object(Closure)#4 (0) {}
var_dump($container['foo']()); // string(3) "foo"
