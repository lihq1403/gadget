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
 * Class Bird.
 */
class Bird
{
    public $head;

    public $wing;

    public $foot;

    public function show()
    {
        echo "头的颜色：{$this->head}" . PHP_EOL;
        echo "翅膀的颜色：{$this->wing}" . PHP_EOL;
        echo "脚的颜色：{$this->foot}" . PHP_EOL;
    }
}

/**
 * 抽象鸟的建造者 - 生成器
 * Class BirdBuilder.
 */
abstract class BirdBuilder
{
    /**
     * @var Bird
     */
    protected $bird;

    public function __construct()
    {
        $this->bird = new Bird();
    }

    abstract public function buildHead();

    abstract public function buildWing();

    abstract public function buildFoot();

    abstract public function getBird(): Bird;
}

/**
 * 具体鸟的建造者 - 蓝色
 * Class BlueBird.
 */
class BlueBird extends BirdBuilder
{
    public function buildHead()
    {
        $this->bird->head = 'Blue';
    }

    public function buildWing()
    {
        $this->bird->wing = 'Blue';
    }

    public function buildFoot()
    {
        $this->bird->foot = 'Blue';
    }

    public function getBird(): Bird
    {
        return $this->bird;
    }
}

/**
 * 具体鸟的建造者 - 玫瑰色
 * Class RoseBird.
 */
class RoseBird extends BirdBuilder
{
    public function buildHead()
    {
        $this->bird->head = 'Red';
    }

    public function buildWing()
    {
        $this->bird->wing = 'Black';
    }

    public function buildFoot()
    {
        $this->bird->foot = 'Green';
    }

    public function getBird(): Bird
    {
        return $this->bird;
    }
}

/**
 * 指挥者
 * Class Director.
 */
class Director
{
    /**
     * @param BirdBuilder $birdBuilder 建造者
     */
    public function createBird(BirdBuilder $birdBuilder): Bird
    {
        $birdBuilder->buildHead();
        $birdBuilder->buildWing();
        $birdBuilder->buildFoot();
        return $birdBuilder->getBird();
    }
}

$director = new Director();

echo '蓝鸟的组成：' . PHP_EOL;
$blue_bird = $director->createBird(new BlueBird());
$blue_bird->show();

echo PHP_EOL;

echo '玫瑰鸟的组成：' . PHP_EOL;
$blue_bird = $director->createBird(new RoseBird());
$blue_bird->show();
