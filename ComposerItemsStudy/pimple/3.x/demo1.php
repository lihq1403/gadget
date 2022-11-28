<?php

use Pimple\Container;

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

$container = new Container();

$container['service'] = function () {
    return new Service();
};

/** @var Service $service */
$service = $container['service']; // share仅调用一次实例
echo $service->bar() . PHP_EOL; // bar

/** @var Service $service */
$service = $container['service']; // 不出现实例信息
echo $service->bar() . PHP_EOL; // bar