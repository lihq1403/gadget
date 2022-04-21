<?php

/**
 * 为了节约内存的使用，享元模式会尽量使类似的对象共享内存。在大量类似对象被使用的情况中这是十分必要的。常用做法是在外部数据结构中保存类似对象的状态，并在需要时将他们传递给享元对象。
 */

interface FlyweightInterface
{
    public function render(string $extrinsicState): string;
}

class CharacterFlyweight implements FlyweightInterface
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render(string $extrinsicState): string
    {
        return sprintf('Character %s with font %s', $this->name, $extrinsicState);
    }
}

class FlyweightFactory implements \Countable
{
    private array $pool = [];

    public function get(string $name): CharacterFlyweight
    {
        if (! isset($this->pool[$name])) {
            $this->pool[$name] = new CharacterFlyweight($name);
        }

        return $this->pool[$name];
    }

    public function count(): int
    {
        return count($this->pool);
    }
}


$characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
$fonts = ['Arial', 'Times New Roman', 'Verdana', 'Helvetica'];

$factory = new FlyweightFactory();

foreach ($characters as $char) {
    foreach ($fonts as $font) {
        $flyweight = $factory->get($char);
        $rendered = $flyweight->render($font);
        echo $rendered . PHP_EOL;
    }
}

var_dump(count($characters));