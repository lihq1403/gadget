<?php

use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

require __DIR__ . '/vendor/autoload.php';

$log = new Logger('log');

$log->pushHandler(new RotatingFileHandler(__DIR__ . '/runtime/daily.log', 2,Logger::WARNING));

$log->warning('warning');
$log->error('error');
$log->info('info'); // 不会被打印出来