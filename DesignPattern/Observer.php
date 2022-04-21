<?php

/**
 * Observer 观察者模式
 * 观察者模式用于实现对对象进行观察：一旦主体对象状态发生改变，与之关联的观察者对象会收到通知，并进行相应操作。

举个例子说明：
假设一个这样的情景，当公司有一个新员工入职了，入职的当天，HR 需要为他办理入职手续，网管需要给他配好电脑和办公用品，部门主管需要带他熟悉部门。传统的编程方式，就是在员工入职这个事件发生的代码之后直接加入处理逻辑，当后续我们需要增加处理逻辑时（比如员工入职后增加培训），代码会变得难以维护。这种方式是耦合的，侵入式的，增加新的逻辑需要改变事件主题的代码。运用观察者模式，将员工的入职作为事件，其他的处理逻辑都做为观察者的操作，那么，当以后需要再增加更多的逻辑时，新增逻辑代码就会很方便。具体代码实现如下。
 */

/**
 * 首先定义一个观察者接口，所有的观察者都实现这个接口
 * Interface observer
 */
interface Observer
{
    public function update();
}

/**
 * 事件生成器的抽象类
 * Class EventGenerator
 */
abstract class EventGenerator
{
    private $observers = [];

    /**
     * 添加观察者
     * @param Observer $observer
     */
    public function addObserver(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * 通知观察者
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

/**
 * 事件类
 * Class Event
 */
class Event extends EventGenerator
{
    /**
     * 定义一个触发观察者的方法
     */
    public function trigger()
    {
        echo "入职Event " . PHP_EOL;

        // 通知观察者
        $this->notify();
    }
}

/**
 * 网管
 * Class NetworkManagerObserver
 */
class NetworkManagerObserver implements Observer
{
    public function update()
    {
        echo "网管给你配好电脑和办公用品" . PHP_EOL;
    }
}

/**
 * 经理
 * Class DirectorObserver
 */
class DirectorObserver implements Observer
{
    public function update()
    {
        echo "经理带你熟悉部门" . PHP_EOL;
    }
}

$event = new Event();

$event->addObserver(new NetworkManagerObserver());
$event->addObserver(new DirectorObserver());

$event->trigger();