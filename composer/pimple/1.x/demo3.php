<?php

require __DIR__ . '/vendor/autoload.php';

class Service
{
    public function __construct()
    {
        echo 'share仅调用一次实例' . PHP_EOL;
    }

    public function bar()
    {
        return 'bar';
    }
}

$container = new Pimple();

$container['service'] = $container->share(function () {
    return new Service();
});

/** @var Service $service */
$service = $container['service']; // share仅调用一次实例
echo $service->bar() . PHP_EOL; // bar

/** @var Service $service */
$service = $container['service']; // 再次获取不会重新new
echo $service->bar() . PHP_EOL; // bar
