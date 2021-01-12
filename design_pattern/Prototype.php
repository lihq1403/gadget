<?php

/**
 *  原型模式就是clone就是内存拷贝，比new的好处是创建对象快速，适合大对象创建

    1.原型模式与工厂模式作用类似,都是用来创建对象
    2.与工厂模式的实现不同,原型模式是先创建好一个原型对象,然后通过clone原型对象来创建新的对象,这样就免去了类创建时重复的初始化操作
    3.原型模式适用于大对象的创建,创建一个大对象需要很大的开销,如果每次new就会消耗很大,原型模式仅需内存拷贝即可
 */

interface Prototype
{
    public function shallowCopy(); // 浅拷贝

    public function deepCopy(); // 深拷贝
}

class ConCreatePrototype implements Prototype
{
    private $_name;

    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function setName($name)
    {
        $this->_name = $name;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function shallowCopy()
    {
        return clone $this;
    }

    public function deepCopy()
    {
        $serializeObj = serialize($this);

        $cloneObj = unserialize($serializeObj);

        return $cloneObj;
    }
}

class Demo
{
    public $string;
}

class UsePrototype
{
    public function shallow()
    {
        $demo = new Demo();
        $demo->string = 'susan';
        $objShallowFirst = new ConCreatePrototype($demo);
        $objShallowSecond = $objShallowFirst->shallowCopy();

        var_dump($objShallowFirst->getName());

        var_dump($objShallowSecond->getName());

        $demo->string = 'sacha';

        var_dump($objShallowFirst->getName());

        var_dump($objShallowSecond->getName());
    }

    public function deep()
    {
        $demo = new Demo();
        $demo->string = 'siri';
        $objDeepFirst = new ConCreatePrototype($demo);
        $objDeepSecond = $objDeepFirst->deepCopy();

        var_dump($objDeepFirst->getName());

        var_dump($objDeepSecond->getName());

        $demo->string = 'demo';

        var_dump($objDeepFirst->getName());

        var_dump($objDeepSecond->getName());
    }
}

$test = new UsePrototype();
$test->shallow();;

$test->deep();

// 浅拷贝：被拷贝对象的所有变量都含有与原对象相同的值，而且对其他对象的引用仍然是指向原来的对象，即浅拷贝只负责当前对象实例，对引用的对象不做拷贝。
//
// 深拷贝：被拷贝对象的所有的变量都含有与原来对象相同的值，除了那些引用其他对象的变量，那些引用其他对象的变量将指向一个被拷贝的新对象，而不再是原来那些被引用的对象。即深拷贝把要拷贝的对象所引用的对象也拷贝了一次。而这种对被引用到的对象拷贝叫做间接拷贝。
//
// 在决定以深拷贝的方式拷贝一个对象的时候，必须决定对间接拷贝的对象时采取浅拷贝还是深拷贝还是继续采用深拷贝。
//
// 序列化深拷贝：利用序列化来做深拷贝，把对象写到流里的过程是序列化的过程，这一过程称为“冷冻”或“腌咸菜”，反序列化对象的过程叫做“解冻”或“回鲜”。