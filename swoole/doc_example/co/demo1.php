<?php

echo "main start\n";

Swoole\Coroutine::create(function () {
    echo "coro ".Swoole\Coroutine::getCid()." start\n";
    swoole_coroutine_create(function () {
        echo "coro ".Swoole\Coroutine::getCid()." start\n";
        Swoole\Coroutine::sleep(.2);
        echo "coro ".Swoole\Coroutine::getCid()." end\n";
    });
    echo "coro ".Swoole\Coroutine::getCid()." do not wait children coroutine\n";
    Swoole\Coroutine::sleep(.1);
    echo "coro ".Swoole\Coroutine::getCid()." end\n";
});

echo "end\n";