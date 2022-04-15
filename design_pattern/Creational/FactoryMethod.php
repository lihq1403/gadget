<?php

/**
 * 工厂方法模式
 *
 * 工厂方法就是为了解决简单工厂扩展性的问题，相信大家再看简单工厂是也发现了其缺陷，
　　
　　以前简单工厂要扩展的时候，需要修改工厂内容，这就违背了设计模式对外扩展开放，对内修改关闭原则，所以搞了个工厂方法模式
 */

interface People
{
    public function marry();
}

class Man implements People
{
    public function marry()
    {
        echo "送玫瑰，送戒指！" . PHP_EOL;
    }
}

class Women implements People
{
    public function marry()
    {
        echo "穿婚纱！" . PHP_EOL;
    }
}

interface CreateMan {
    public function create();
}

class FactoryMan implements CreateMan
{
    public function create(): Man
    {
        return new Man();
    }
}

class FactoryWoman implements CreateMan
{
    public function create(): Women
    {
        return new Women();
    }
}

class Client
{
    public function test() {
        $factory = new FactoryMan();
        $man = $factory->create();
        $man->marry();

        $factory = new FactoryWoman();
        $woman = $factory->create();
        $woman->marry();
    }
}

(new Client())->test();