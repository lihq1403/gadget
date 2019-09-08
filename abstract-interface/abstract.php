<?php

/**
 * 抽象类
 * Class Animal
 */

abstract class Animal {
    protected $name = 'animal';

    abstract public function call();

    abstract public function run();

    public function getName()
    {
        return $this->name;
    }
}

class Cat extends Animal {
    protected $name = 'cat';

    public function call()
    {
        echo $this->getName() . ': 喵喵叫～' . PHP_EOL;
    }

    public function run()
    {
        echo $this->getName() . '在跑～' . PHP_EOL;
    }
}

class Dog extends Animal {
    protected $name = 'dog';

    public function call()
    {
        echo $this->getName() . ': 汪汪叫～' . PHP_EOL;
    }

    public function run()
    {
        echo $this->getName() . '在跑～' . PHP_EOL;
    }
}

$cat = new Cat();
$cat->call();
$cat->run();

$dog = new Dog();
$dog->call();
$dog->run();