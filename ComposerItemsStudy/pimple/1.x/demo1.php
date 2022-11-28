<?php

require __DIR__ . '/vendor/autoload.php';

$container = new Pimple();
$container['bar'] = 'foo';
var_dump($container['bar']); // string(3) "foo"
