<?php

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

require __DIR__ . '/vendor/autoload.php';

$log = new Logger('log');

$path = __DIR__ . '/runtime/simple.log';
//$path = 'php://stdout';
$log->pushHandler(new StreamHandler($path, Logger::WARNING));

$log->warning('warning');
$log->error('error');
$log->info('info'); // 不会被打印出来