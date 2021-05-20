<?php

/**
 * 代理模式（Proxy）为其他对象提供一种代理以控制对这个对象的访问。使用代理模式创建代理对象，让代理对象控制目标对象的访问（目标对象可以是远程的对象、创建开销大的对象或需要安全控制的对象），并且可以在不改变目标对象的情况下添加一些额外的功能。
 */

class Record
{
    private $data;

    public function __construct(array $data = [])
    {
        $this->data = $data;
    }

    public function __set(string $name, string $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }
}

class RecordProxy extends Record
{
    private $isDirty = false;

    private $isInitialized  = false;

    public function __construct(array $data)
    {
        parent::__construct($data);

        if (count($data) > 0) {
            $this->isInitialized  = true;
            $this->isDirty = true;
        }
    }

    public function __set(string $name, string $value)
    {
        $this->isDirty = true;

        parent::__set($name, $value);
    }

    public function isDirty(): bool
    {
        return $this->isDirty;
    }

    public function isisInitialized(): bool
    {
        return $this->isInitialized;
    }
}

$data = [];
$proxy = new RecordProxy($data);
$proxy->xyz = false;

var_dump($proxy->xyz);
var_dump($proxy->isDirty());