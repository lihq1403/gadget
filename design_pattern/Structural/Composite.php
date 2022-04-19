<?php

/**
 * 组合模式
 */


abstract class Component
{
    protected $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    abstract public function add(Component $component);
    abstract public function remove(Component $component);
    abstract public function display($depth);
}

/**
 * 叶节点对线没有子节点
 * 由于叶子没有再增加分枝和树叶，所以add和remove方法实现它没有意义
 * 但这样做可以消除叶节点和枝节点对象在抽象层次的区别，它们具有完全一致的接口
 */
class Leaf extends Component
{
    public function add(Component $component)
    {
        echo "can not add to a leaf" . PHP_EOL;
    }

    public function remove(Component $component)
    {
        echo "can not remove to a leaf" . PHP_EOL;
    }

    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name . PHP_EOL;
    }
}

/**
 * composite定义有枝节点行为，用来存储子部件，在Component接口中实现与子部件有关的操作，比如增加add和删除remove.
 */
class Composite extends Component
{
    private array $children = [];

    public function add(Component $component)
    {
        $this->children[] = $component;
    }

    public function remove(Component $component)
    {
        foreach ($this->children as $key => $value) {
            if ($component === $value) {
                unset($this->children[$key]);
            }
        }
    }

    public function display($depth)
    {
        echo str_repeat('-', $depth).$this->name . PHP_EOL;
        foreach ($this->children as $component) {
            $component->display($depth + 2);
        }
    }

}

//客户端代码

$root = new Composite('root'); // 根节点
$root->add(new Leaf("Leaf A"));
$root->add(new Leaf("Leaf B"));

$comp = new Composite("Composite X");
$comp->add(new Leaf("Leaf XA"));
$comp->add(new Leaf("Leaf XB"));

$root->add($comp);

$comp2 = new Composite("Composite X");
$comp2->add(new Leaf("Leaf XA"));
$comp2->add(new Leaf("Leaf XB"));

$comp->add($comp2);

$root->add(new  Leaf("Leaf C"));

$leaf = new Leaf("Leaf D");
$root->add($leaf);
$root->remove($leaf);

$root->display(1);