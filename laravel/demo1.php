<?php

interface Log
{
    public function write();
}

class FileLog implements Log
{
    public function write()
    {
        echo 'file log write...';
    }
}

class DatabaseLog implements Log
{
    public function write()
    {
        echo 'file log write...'.PHP_EOL;
    }
}

class User
{
    protected $log;

    public function __construct(FileLog $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        // 登录成功，记录登录日志
        echo 'login success...'.PHP_EOL;
        $this->log->write();
    }
}

function make($concrete)
{
    // 获取反射类
    $reflector = new ReflectionClass($concrete);
    // 构造函数
    $constructor = $reflector->getConstructor();
    if (is_null($constructor)) {
        return $reflector->newInstance();
    }
    // 构造函数参数
    $dependencies = $constructor->getParameters();
    // 根据参数返回实例
    $instances = getDependencies($dependencies);
    // 生成类
    return $reflector->newInstanceArgs($instances);
}

function getDependencies($parameters)
{
    $dependencies = [];
    foreach ($parameters as $parameter) {
        $dependencies[] = make($parameter->getClass()->name);
    }
    return $dependencies;
}

$user = make(User::class);
$user->login();
