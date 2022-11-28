<?php

// 创建Server对象，监听9501端口
$server = new Swoole\Server('0.0.0.0', 9501);

// 监听连接进入事件
$server->on('Connect', function ($serv, $fd) {
    echo "Client: {$fd} Connect.\n";
});

// 监听数据接收事件
$server->on('Receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: {$data} FromId: {$from_id} \n");
});

// 监听连接关闭事件
$server->on('Close', function ($serv, $fd) {
    echo "Client: {$fd} Close.\n";
});

// 启动服务器
$server->start();

