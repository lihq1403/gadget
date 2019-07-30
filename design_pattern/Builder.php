<?php

/**
 * 建造者模式
 * 建造者模式也称生成器模式，核心思想是将一个复杂对象的构造与它的表示分离，使同样的构建过程可以创建不同的表示，这样的设计模式被称为建造者模式。
 * 例如：汽车，他的发动机引擎有好多品牌，轮胎也有各种材质，内饰更是千奇百怪；鸟，他的头、翅膀以及脚有各种颜色和形状，在创建这种复杂对象的时候，我们建议使用建造者模式。
 *
     建造者模式一般认为有四个角色：

     1.产品角色，产品角色定义自身的组成属性

     2.抽象建造者，抽象建造者定义了产品的创建过程以及如何返回一个产品

     3.具体建造者，具体建造者实现了抽象建造者创建产品过程的方法，给产品的具体属性进行赋值定义

     4.指挥者，指挥者负责与调用客户端交互，决定创建什么样的产品
 */

/**
 * 具体产品角色 鸟
 * Class Bird
 */
class Bird
{
    public $_head;
    public $_wing;
    public $_foot;

    public function show() {
        echo "头的颜色：{$this->_head}<br>";
        echo "翅膀的颜色：{$this->_wing}<br>";
        echo "脚的颜色：{$this->_foot}<br>";
    }
}

/**
 * 抽象鸟的建造者 - 生成器
 * Class BirdBuilder
 */
abstract class BirdBuilder
{
    protected $_bird;

    public function __construct()
    {
        $this->_bird = new Bird();
    }

    abstract function BuildHead();
    abstract function BuildWing();
    abstract function BuildFoot();
    abstract function GetBird();
}

/**
 * 具体鸟的建造者 - 蓝色
 * Class BlueBird
 */
class BlueBird extends BirdBuilder
{
    public function BuildHead()
    {
        $this->_bird->_head = "Blue";
    }

    public function BuildWing()
    {
        $this->_bird->_wing = "Blue";
    }

    public function BuildFoot()
    {
        $this->_bird->_foot = "Blue";
    }

    public function GetBird()
    {
        return $this->_bird;
    }
}

/**
 * 具体鸟的建造者 - 玫瑰色
 * Class RoseBird
 */
class RoseBird extends BirdBuilder
{
    public function BuildHead()
    {
        $this->_bird->_head = "Red";
    }

    public function BuildWing()
    {
        $this->_bird->_wing = "Black";
    }

    public function BuildFoot()
    {
        $this->_bird->_foot = "Green";
    }

    public function GetBird()
    {
        return $this->_bird;
    }
}

/**
 * 指挥者
 * Class Director
 */
class Director
{
    /**
     * @param BirdBuilder $birdBuilder 建造者
     * @return mixed 产品
     */
    public function createBird(BirdBuilder $birdBuilder)
    {
        $birdBuilder->BuildHead();
        $birdBuilder->BuildWing();
        $birdBuilder->BuildFoot();
        return $birdBuilder->GetBird();
    }
}

$director = new Director();

echo "蓝鸟的组成：<br>";
$blue_bird = $director->createBird(new BlueBird());
$blue_bird->show();

echo "<hr>玫瑰鸟的组成：<br>";
$blue_bird = $director->createBird(new RoseBird());
$blue_bird->show();