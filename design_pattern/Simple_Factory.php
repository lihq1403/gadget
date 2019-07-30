<?php

/**
 * 简单工厂模式
 * 定义一个工厂类，它可以根据参数的不同返回不同类的实例，被创建的实例通常都具有共同的父类。因为在简单工厂模式中用于创建实例的方法是静态（static）方法，因此简单工厂模式又被称为静态工厂方法（Static Factory Method）模式，它属于类创建型模式。
 *
优点：
增加产品的时候，只需要修改 Factory 类，增加相应的逻辑即可。
需要改进的地方：
在工厂类的内部用了 switch 语句，用于判断 new 什么对象 (生产什么车)，这就是耦合的表现。
 */


class VwCar{
    public function __construct()
    {
        echo "I'm Vm!";
    }
}

class AudiCar{
    public function __construct()
    {
        echo "I'm Audi!";
    }
}

class Simple_Factory
{
    const VM = 1;
    const AUDI = 2;

    public function produce($type)
    {
        switch ($type) {
            case self::VM:
                return new VwCar();
                break;
            case self::AUDI:
                return new AudiCar();
                break;
            default:
                return [];
        }
    }
}

$factory = new Simple_Factory();
$vm = $factory->produce(Simple_Factory::VM);