<?php

require_once __DIR__ . '/../vendor/autoload.php';

// 连接RabbitMQ
$connection = new \PhpAmqpLib\Connection\AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
// 创建一个通道
$channel = $connection->channel();
// 声明一个队列
$channel->queue_declare('task_queue', false, true, false, false);

echo " [*] Waiting for messages. To exit press CTRL+C\n";

$callback = function ($msg) {
    echo ' [x] Received ', $msg->body, "\n";
    // 假装耗时任务，一个.代表1秒
    sleep(substr_count($msg->body, '.'));
    echo " [x] Done\n";
    // 消费者发送回一个确认
    $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
};

$channel->basic_qos(null, 1, null);
$channel->basic_consume('task_queue', '', false, false, false, false, $callback);

while ($channel->is_consuming()) {
    $channel->wait();
}

$channel->close();
$connection->close();