<?php

/**
 * 多例模式
 *
多例模式是指存在一个类有多个相同实例，而且该实例都是该类本身。这个类叫做多例类。
多例模式的特点是：
1、多例类可以有多个实例。
2、多例类必须自己创建、管理自己的实例，并向外界提供自己的实例。
多例模式实际上就是单例模式的推广。
 */

final class Multiton
{
    const INSTANCE_1 = '1';
    const INSTANCE_2 = '2';

    /**
     * @var array 实例数组
     */
    private static $instances = [];

    /**
     * 这里私有方法阻止用户随意的创建该对象实例
     */
    private function __construct()
    {
    }

    public static function getInstance(string $instanceName): Multiton
    {
        if (!isset(self::$instances[$instanceName])) {
            self::$instances[$instanceName] = new self();
        }

        return self::$instances[$instanceName];
    }

    /**
     * 该私有对象阻止实例被克隆
     */
    private function __clone()
    {
    }

    /**
     * 该私有方法阻止实例被序列化
     */
    private function __wakeup()
    {
    }
}

$instance1 = Multiton::getInstance('1');
var_dump($instance1);
$instance2 = Multiton::getInstance('2');
var_dump($instance2);