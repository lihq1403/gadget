<?php

/**
 * 观察者
 * Interface Observer
 */
interface Observer
{
    public function update($event_info = null);
}

class Observer1 implements Observer
{
    public function update($event_info = null)
    {
        echo '观察者1 收到执行通知 执行完毕！'.PHP_EOL;
    }
}

class Observer2 implements Observer
{
    public function update($event_info = null)
    {
        echo '观察者2 收到执行通知 执行完毕！'.PHP_EOL;
    }
}

class Event
{
    protected $observers = [];

    public function add(Observer $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * 事件通知
     */
    public function notify()
    {
        /** @var Observer $observer */
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }

    /**
     * 触发事件
     */
    public function trigger()
    {
        $this->notify();
    }
}

//创建一个事件
$event = new Event();
//为事件增加观察者
$event->add(new Observer1());
$event->add(new Observer2());
//执行事件
$event->trigger();