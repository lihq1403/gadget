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
$container['service'] = function () {
    return new Service();
};

/** @var Service $service */
$service = $container['service'];
echo $service->bar(); // bar
