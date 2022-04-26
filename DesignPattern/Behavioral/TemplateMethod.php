<?php

/**
 * 模板方法模式是一种行为型的设计模式。

可能你已经见过这种模式很多次了。它是一种让抽象模板的子类「完成」一系列算法的行为策略。

众所周知的「好莱坞原则」：「不要打电话给我们，我们会打电话给你」。这个类不是由子类调用的，而是以相反的方式。怎么做？当然很抽象啦！

换而言之，它是一种非常适合框架库的算法骨架。用户只需要实现子类的一种方法，其父类便可去搞定这项工作了。

这是一种分离具体类的简单办法，且可以减少复制粘贴，这也是它常见的原因。
 */

abstract class Journey
{
    private array $thingsToDo = [];

    final public function takeATrip()
    {
        $this->thingsToDo[] = $this->buyAFlight();
        $this->thingsToDo[] = $this->takePlane();
        $this->thingsToDo[] = $this->enjoyVacation();
        $buyGift = $this->buyGift();
        $buyGift && $this->thingsToDo[] = $buyGift;
        $this->thingsToDo[] = $this->takePlaneBack();
    }

    public function getThingsToDo(): array
    {
        return $this->thingsToDo;
    }

    /**
     * 这个方法必须要实现，它是这个模式的关键点.
     */
    abstract protected function enjoyVacation(): string;

    protected function buyGift()
    {
        return null;
    }

    private function buyAFlight(): string
    {
        return '买机票';
    }

    private function takePlane(): string
    {
        return '坐飞机';
    }

    private function takePlaneBack(): string
    {
        return '坐飞机回程';
    }
}

class BeachJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return '游泳和晒日光浴的沙滩旅行';
    }
}

class CityJourney extends Journey
{
    protected function enjoyVacation(): string
    {
        return '吃喝玩乐的城市旅行';
    }

    protected function buyGift(): string
    {
        return '购买礼物';
    }
}

$beach = new BeachJourney();
$beach->takeATrip();
foreach ($beach->getThingsToDo() as $item) {
    echo $item . PHP_EOL;
}

echo PHP_EOL;

$city = new CityJourney();
$city->takeATrip();
foreach ($city->getThingsToDo() as $item) {
    echo $item . PHP_EOL;
}