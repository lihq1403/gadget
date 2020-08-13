<?php

require_once __DIR__ . '/../vendor/autoload.php';

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Wire\AMQPTable;
use PhpAmqpLib\Message\AMQPMessage;

// 连接RabbitMQ
$connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
// 创建一个通道
$channel = $connection->channel();

$exchange_name = 'test_exchange';
$queue_name    = 'test_queue';

// 定义默认的交换器
$channel->exchange_declare($exchange_name, 'topic', false, true, false);
// 定义延迟交换器
$channel->exchange_declare('delayed_exchange', 'topic', false, true, false);

//定义延迟队列
$channel->queue_declare('delayed_queue', false, true, false, false, false, new AMQPTable(array(
    "x-dead-letter-exchange"    => "delayed_exchange",
    "x-dead-letter-routing-key" => "delayed_exchange",
    "x-message-ttl"             => 5000, //5秒延迟
)));
//绑定延迟队列到默认队列上
$channel->queue_bind('delayed_queue', $exchange_name);

// 声明一个队列
$channel->queue_declare($queue_name, false, true, false, false, false);
//绑定正常消费队列到延迟交换器上
$channel->queue_bind($queue_name, 'delayed_exchange', 'delayed_exchange');

$nowTime = date('H:i:s');
$msg = new AMQPMessage('Hello World 发送时间：'. $nowTime, [
    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT
]);
$channel->basic_publish($msg, $exchange_name);

echo " [x] Sent 'Hello World!'\n";

$channel->close();
$connection->close();