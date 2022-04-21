<?php

/**
 * 门面模式的最初目的并不是为了避免让你阅读复杂的 API 文档，这只是一个附带作用。其实它的本意是为了降低耦合性并且遵循 Demeter 定律。

一个门面旨在通过嵌入许多（但有时只有一个）接口来分离客户端和子系统。当然，也是为了降低复杂度。

门面不会禁止你访问子系统。
你可以（应该）有多个门面对应一个子系统。
这就是为什么一个好的门面里没有 new 的原因。如果每个方法都有多种创建，那并不是一个门面，而是一个构建器 [抽象的 | 静态的 | 简单的] 或是一个工厂 [方法] 。

最好的门面是没有 new 的，并且其构造函数带有接口类型提示的参数。 如果你需要创建新的实例，可以使用工厂作为变量。
 */

interface OsInterface
{
    /**
     * 关机.
     */
    public function halt();

    /**
     * 获取名称.
     */
    public function getName(): string;
}

class WinOs implements OsInterface
{
    public function halt()
    {
        echo 'WinOs halt' . PHP_EOL;
    }

    public function getName(): string
    {
        return 'Win10';
    }
}

interface BiosInterface
{
    /**
     * 执行.
     */
    public function execute();

    /**
     * 等待密码输入.
     */
    public function waitForKeyPass();

    /**
     * 启动.
     */
    public function launch(OsInterface $os);

    /**
     * 关机.
     */
    public function powerDown();
}

class GIGABYTE implements BiosInterface
{
    public function execute()
    {
        echo 'GIGABYTE execute' . PHP_EOL;
    }

    public function waitForKeyPass()
    {
        echo 'GIGABYTE waitForKeyPass' . PHP_EOL;
    }

    public function launch(OsInterface $os)
    {
        echo 'GIGABYTE launch os : ' . $os->getName() . PHP_EOL;
    }

    public function powerDown()
    {
        echo 'GIGABYTE powerDown' . PHP_EOL;
    }
}

class Facade
{
    /**
     * 定义操作系统接口变量.
     */
    private OsInterface $os;

    /**
     * 定义基础输入输出系统接口变量.
     */
    private BiosInterface $bios;

    public function __construct(BiosInterface $bios, OsInterface $os)
    {
        $this->bios = $bios;
        $this->os = $os;
    }

    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPass();
        $this->bios->launch($this->os);
    }

    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown();
    }
}

$bios = new GIGABYTE();
$os = new WinOs();
$facade = new Facade($bios, $os);
$facade->turnOn();
$facade->turnOff();
