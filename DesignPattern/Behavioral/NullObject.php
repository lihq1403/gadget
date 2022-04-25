<?php

/**
 * 空对象模式不属于 GoF 设计模式，但是它作为一种经常出现的套路足以被视为设计模式了。它具有如下优点：

客户端代码简单
可以减少报空指针异常的几率
测试用例不需要考虑太多条件
返回一个对象或 null 应该用返回对象或者 NullObject 代替。NullObject 简化了死板的代码，消除了客户端代码中的条件检查，例如 if (!is_null($obj)) { $obj->callSomething(); } 只需 $obj->callSomething(); 就行。
 *
 * 例子：
 * Symfony2: 空日志
Symfony2: Symfony/Console 空输出
责任链模式中的空处理器
命令行模式中的空命令
 */

interface LoggerInterface
{
    public function log(string $message);
}

class Service
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function doSomething()
    {
        // 提示：这里你只是使用它，而不需要通过如：is_null() 检查 $logger 是否已经设置。
        $this->logger->log('We are in ' . __METHOD__);
    }
}

/**
 * 创建一个日记打印类实现日记接口。
 */
class PrintLogger implements LoggerInterface
{
    public function log(string $message)
    {
        echo $message . PHP_EOL;
    }
}

/**
 * 创建一个空日记类实现日记接口。
 */
class NullLogger implements LoggerInterface
{
    public function log(string $message)
    {
        // 什么也不用做
    }
}

$service1 = new Service(new PrintLogger());
$service2 = new Service(new NullLogger());

$service1->doSomething();
$service2->doSomething();
