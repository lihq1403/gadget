<?php

require_once __DIR__ . '/../vendor/autoload.php';

// 连接RabbitMQ
$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
// 创建一个通道
$channel = $connection->channel();
// 声明一个队列
$channel->queue_declare('hello', false, false, false, false);

$msg = new \PhpAmqpLib\Message\AMQPMessage('Hello World');
$channel->basic_publish($msg, '', 'hello');

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();