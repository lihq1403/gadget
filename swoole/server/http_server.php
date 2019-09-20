<?php

$http = new Swoole\Http\Server('0.0.0.0', 8811);

$http->on('request', function ($request, $response) {
//    print_r($request->get);
    $response->cookie('l', 'xsss', time() + 1800);
    $response->end("<h1>HTTP Server</h1>" . "GET:". json_encode($request->get, 256));
});

$http->start();