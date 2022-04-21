<?php

/**
 * 注册模式
 * 注册模式（Registry）也叫做注册树模式，注册器模式。注册模式为应用中经常使用的对象创建一个中央存储器来存放这些对象 —— 通常通过一个只包含静态方法的抽象类来实现（或者通过单例模式）
 */

class Registry
{
    /**
     * 树的枝干-用于储存树上的果实（实例）.
     */
    public static array $objects;

    /**
     * 将实例插入注册树中.
     * @param string $alias | 对象别名-注册树中的名称
     * @param object $object | 对象实例
     */
    public static function set(string $alias, object $object)
    {
        self::$objects[$alias] = $object;
    }

    /**
     * 从注册树中读取实例.
     * @param string $alias 对象别名-注册树中的名称
     * @return bool|mixed 返回的对象实例
     */
    public static function get(string $alias)
    {
        if (isset(self::$objects[$alias])) {
            return self::$objects[$alias];
        }
        echo '您要找的对象实例不存在哦' . PHP_EOL;
        return false;
    }

    /**
     * 销毁注册树中的实例.
     * @param string $alias 对象别名-注册树中的名称
     */
    public static function del(string $alias)
    {
        unset(self::$objects[$alias]);
    }
}

class Leaf
{
    public function index()
    {
        echo '我是一片叶子' . PHP_EOL;
    }
}

// 实例化测试类，获取对象实例
$leaf = new Leaf();
// 注册到树上
Registry::set('leaf', $leaf);
// 取出来
$leafClass = Registry::get('leaf');
// 测试
$leafClass->index();
// 销毁
Registry::del('leaf');
// 尝试再次取出来
$leafClass2 = Registry::get('leaf');
var_dump($leafClass2);
