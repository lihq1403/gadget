<?php

require __DIR__ . '/vendor/autoload.php';

$container = new Pimple();
$container['service'] = function () {
    return 'service';
};

$container['service'] = $container->extend('service', function ($service) {
    return $service . ' extend';
});

var_dump($container['service']); // string(14) "service1 extend"
