<?php

/**
 * 访问者模式，表示一个作用于某对象结构中的各个元素的操作。它使你可以在不改变各元素的类的前提下定义作用于这些元素的新操作。

访问者模式适合用于数据结构相对稳定的系统。它把数据结构和作用于结构上的操作之间的耦合解脱开，使得操作集合可以相对自由地演化。

访问者的目的是要把处理从数据结构分离出来。这样系统有比较稳定的数据结构，又有易于变化的算法的话，使用访问者模式就是比较合适的，因为访问者模式使得算法操作的增加变得容易。

增加新的操作容易，因为增加新的操作就意味着增加一个新的访问者。访问者将有关行为集中到一个访问者对象中。

访问者模式使增加新的数据结构变得困难了。
 */

abstract class Action
{
    abstract public function getManConclusion(Man $concreteElementA);

    abstract public function getWomanConclusion(Woman $concreteElementB);
}

abstract class Person
{
    abstract public function accept(Action $visitor);
}

class Man extends Person
{
    public function accept(Action $visitor)
    {
        $visitor->getManConclusion($this);
    }
}

class Woman extends Person
{
    public function accept(Action $visitor)
    {
        $visitor->getWomanConclusion($this);
    }
}

class Success extends Action
{
    public function getManConclusion(Man $concreteElementA)
    {
        echo '背后多半有一个伟大的女人' . PHP_EOL;
    }

    public function getWomanConclusion(Woman $concreteElementB)
    {
        echo '背后多有一个不成功的男人' . PHP_EOL;
    }
}

class Failing extends Action
{
    public function getManConclusion(Man $concreteElementA)
    {
        echo '男人失败时，闷头喝酒，谁也不用劝' . PHP_EOL;
    }

    public function getWomanConclusion(Woman $concreteElementB)
    {
        echo '女人失败时，眼泪汪汪，谁也劝不了' . PHP_EOL;
    }
}

class Amativeness extends Action
{
    public function getManConclusion(Man $concreteElementA)
    {
        echo '男人恋爱时，凡事不懂也要装懂' . PHP_EOL;
    }

    public function getWomanConclusion(Woman $concreteElementB)
    {
        echo '女人恋爱时，遇事懂也装作不懂' . PHP_EOL;
    }
}

class ObjectStructure
{
    /**
     * @var Person[]
     */
    private array $person = [];

    public function acctch(Person $person)
    {
        $this->person[] = $person;
    }

    public function display(Action $visitor)
    {
        foreach ($this->person as $person) {
            $person->accept($visitor);
        }
    }
}


$o = new ObjectStructure();
$o->acctch(new Man());
$o->acctch(new Woman());

// 成功时的反应
$v1 = new Success();
$o->display($v1);

$v2 = new Failing();
$o->display($v2);

$v3 = new Amativeness();
$o->display($v3);
