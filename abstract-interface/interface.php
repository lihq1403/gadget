<?php

/**
 * 接口
 * Interface Animal
 */

interface Animal {
    public function call();
    public function run();
}

class HasName {
    protected $name = 'name';

    public function getName()
    {
        return $this->name;
    }
}

class Cat extends HasName implements Animal {
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

class Dog  extends HasName implements Animal {
    protected $name = 'dog';

    public function call() {
        echo $this->getName() . ': 汪汪叫～' . PHP_EOL;
    }

    public function run() {
        echo $this->getName() . '在跑～' . PHP_EOL;
    }
}

$cat = new Cat();
$cat->call();
$cat->run();

$dog = new Dog();
$dog->call();
$dog->run();

/**
 * 接口（interface）:

使用接口（interface），可以指定某个类必须实现哪些方法，但不需要定义这些方法的具体内容。
接口是通过 interface 关键字来定义的，就像定义一个标准的类一样，但其中定义所有的方法都是空的。
接口中定义的所有方法都必须是公有，这是接口的特性。
要实现一个接口，使用 implements 操作符。类中必须实现接口中定义的所有方法，否则会报一个致命错误。类可以实现多个接口，用逗号来分隔多个接口的名称。
实现多个接口时，接口中的方法不能有重名。
接口也可以继承，通过使用extends操作符.
类要实现接口，必须使用和接口中所定义的方法完全一致的方式。否则会导致致命错误.
 */


/**
 * 区别:

对接口的继承使用implements,抽象类使用extends
接口中不可以声明变量,但可以声明类常量.抽象类中可以声明各种变量
接口没有构造函数,抽象类可以有
接口中的方法默认为public,抽象类中的方法可以用public,protected,private修饰
一个类可以继承多个接口,但只能继承一个抽象类
接口的定义用interface,抽象类定义用abstract
 */