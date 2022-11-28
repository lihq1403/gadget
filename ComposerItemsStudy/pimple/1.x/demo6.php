<?php

require __DIR__ . '/vendor/autoload.php';

class Service
{
    public function bar()
    {
        return 'bar';
    }
}

$container = new Pimple();

$container['service'] = $container->share(function () {
    return new Service();
});

var_dump($container['service']); // object(Service)#5 (0) {}

var_dump($container->raw('service')); // object(Closure)#4 (2) {}
