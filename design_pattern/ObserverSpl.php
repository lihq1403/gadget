<?php

class MyObserver1 implements SplObserver {
    public function update(SplSubject $subject) {
        echo __CLASS__ . ' - ' . $subject->getName() . PHP_EOL;
    }
}

class MyObserver2 implements SplObserver {
    public function update(SplSubject $subject) {
        echo __CLASS__ . ' - ' . $subject->getName() . PHP_EOL;
    }
}

class MySubject implements SplSubject {
    private $observers;
    private $name;

    public function __construct($name) {
        $this->observers = new SplObjectStorage();
        $this->name = $name;
    }

    public function attach(SplObserver $observer) {
        $this->observers->attach($observer);
    }

    public function detach(SplObserver $observer) {
        $this->observers->detach($observer);
    }

    public function notify() {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function getName() {
        return $this->name;
    }
}

$observer1 = new MyObserver1();
$observer2 = new MyObserver2();

$subject = new MySubject("test");

$subject->attach($observer1);
$subject->attach($observer2);
$subject->notify();

/*
输出:

MyObserver1 - test
MyObserver2 - test
*/

$subject->detach($observer2);
$subject->notify();

/*
输出:

MyObserver1 - test
*/