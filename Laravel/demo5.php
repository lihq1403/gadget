<?php

interface Middleware
{
    public static function handle(Closure $next);
}

class VerifyToken implements Middleware
{
    public static function handle(Closure $next)
    {
        echo '验证Token' . PHP_EOL;
        $next();
    }
}

class VerifyAuth implements Middleware
{
    public static function handle(Closure $next)
    {
        echo '验证是否登录' . PHP_EOL;
        $next();
    }
}

class SetCookie implements Middleware
{
    public static function handle(Closure $next)
    {
        $next();
        echo '设置cookie信息' . PHP_EOL;
    }
}

$handle = function () {
    echo '当前执行程序' . PHP_EOL;
};

$pipeArr = [
    'VerifyToken',
    'VerifyAuth',
    'SetCookie',
];

$callback = array_reduce($pipeArr, function ($stack, $pipe) {
    return function () use ($stack, $pipe) {
        return $pipe::handle($stack);
    };
}, $handle);

call_user_func($callback);

//$VerifyToken = function () use ($handle) {
//    VerifyToken::handle($handle);
//};
//
//$VerifyAuth = function () use ($VerifyToken) {
//    VerifyAuth::handle($VerifyToken);
//};
//
//$SetCookie = function () use ($VerifyAuth) {
//    SetCookie::handle($VerifyAuth);
//};
//
//call_user_func($SetCookie);
