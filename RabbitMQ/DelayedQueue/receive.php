<?php

require_once __DIR__ . '/../vendor/autoload.php';

// 连接RabbitMQ
$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
// 创建一个通道
$channel = $connection->channel();

$queue_name = 'test_queue';

// 声明一个队列
$channel->queue_declare($queue_name, false, true, false, false, false);

echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";

$callback = function ($msg) {
    echo " [x] Received ", $msg->body, ' 接受时间：', date('H:i:s'), "\n";
};

$channel->basic_consume($queue_name, '', false, true, false, false, $callback);

while (count($channel->callbacks)) {
    $channel->wait();
}