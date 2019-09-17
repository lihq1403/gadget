<?php

/**
 * 实现自动依赖注入
 * Class Ioc
 */
class Ioc
{
    /**
     * 获得类的对象实例
     * @param $className
     * @return object
     * @throws ReflectionException
     */
    public static function getInstance($className)
    {
        $paramArr = self::getMethodParams($className);

        return (new ReflectionClass($className))->newInstanceArgs($paramArr);
    }

    /**
     * 执行类的方法
     * @param $className
     * @param $methodName
     * @param array $params
     * @return mixed
     * @throws ReflectionException
     */
    public static function make($className, $methodName, $params = [])
    {
        // 获取类的实例
        $instance = self::getInstance($className);

        // 获取该方法所需要依赖注入的参数
        $paramArr = self::getMethodParams($className, $methodName);

        return $instance->{$methodName}(...array_merge($paramArr, $params));

    }

    /**
     * @param $className
     * @param string $methodsName
     * @return array
     * @throws ReflectionException
     */
    protected static function getMethodParams($className, $methodsName = '__construct')
    {
        // 通过反射获得该类
        $class = new ReflectionClass($className);
        $paramArr = []; // 记录参数 和 参数类型

        // 判读该类是否有构造函数
        if ($class->hasMethod($methodsName)) {
            // 获得构造函数
            $construct = $class->getMethod($methodsName);

            // 判断构造函数是否有参数
            $params = $construct->getParameters();

            if (count($params) > 0) {
                // 判断参数类型
                foreach ($params as $key => $param) {
                    if ($paramClass = $param->getClass()) {
                        // 获得参数类型名称
                        $paramClassName = $paramClass->getName();

                        // 获得参数类型
                        $args = self::getMethodParams($paramClassName);
                        $paramArr[] = (new ReflectionClass($paramClass->getName()))->newInstanceArgs($args);
                    }
                }
            }
        }
        return $paramArr;
    }
}

class A
{
    protected $cObj;

    /**
     * 用于测试多级依赖注入，B依赖A，A依赖C
     * A constructor.
     * @param C $c
     */
    public function __construct(C $c)
    {
        $this->cObj = $c;
    }

    public function aa()
    {
        echo 'this is A->aa()'.PHP_EOL;
    }

    public function aac()
    {
        $this->cObj->cc();
    }
}

class B
{
    protected $aObj;

    /**
     * 测试构造函数依赖注入
     * B constructor.
     * @param A $a
     */
    public function __construct(A $a)
    {
        $this->aObj = $a;
    }

    /**
     * 测试方法调用依赖注入
     * @param C $c
     * @param $b
     */
    public function bb(C $c, $b)
    {
        $c->cc();
        echo 'params:'.$b;
    }

    /**
     * 验证依赖注入是否成功
     */
    public function bbb()
    {
        $this->aObj->aac();
    }
}

class C
{
    public function cc()
    {
        echo 'this is C->cc()'.PHP_EOL;
    }
}

// 1、测试构造函数的依赖注入

// 使用IOC来创建B类实例，B的构造函数依赖于A，A的构造函数依赖于C类
$bObj = Ioc::getInstance('B');
$bObj->bbb(); // 输出：this is C->cc() ， 说明依赖注入成功

var_dump($bObj);

// 2、测试方法依赖注入
Ioc::make('B', 'bb', ['this is param b']);

