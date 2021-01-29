<?php

interface OsInterface
{
    /**
     * 关机
     */
    public function halt();

    /**
     * 获取名称
     */
    public function getName(): string;
}

class WinOs implements OsInterface
{
    public function halt()
    {
        echo 'WinOs halt'.PHP_EOL;
    }

    public function getName(): string
    {
        return 'Win10';
    }
}

interface BiosInterface
{
    /**
     * 执行
     */
    public function execute();

    /**
     * 等待密码输入
     */
    public function waitForKeyPass();

    /**
     * 启动
     */
    public function launch(OsInterface $os);

    /**
     * 关机
     */
    public function powerDown();
}

class GIGABYTE implements BiosInterface
{
    public function execute()
    {
        echo 'GIGABYTE execute'.PHP_EOL;
    }

    public function waitForKeyPass()
    {
        echo 'GIGABYTE waitForKeyPass'.PHP_EOL;
    }

    public function launch(OsInterface $os)
    {
        echo 'GIGABYTE launch os : '.$os->getName().PHP_EOL;
    }

    public function powerDown()
    {
        echo 'GIGABYTE powerDown'.PHP_EOL;
    }

}

class Facade
{
    /**
     * 定义操作系统接口变量
     * @var OsInterface
     */
    private $os;

    /**
     * 定义基础输入输出系统接口变量
     * @var BiosInterface
     */
    private $bios;

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

