<?php

class Person
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$zhangsan = new Person('张三');
$lisi = new Person('李四');
$wangwu = new Person('王五');
$zhaoliu = new Person('赵六');

$container = new SplObjectStorage();

$container->attach($zhangsan);
$container->attach($lisi);
$container->attach($wangwu);

var_dump($container->count()); // int(3)

// 检查是否在对象存储空间里
var_dump($container->contains($zhangsan)); // bool(true)
var_dump($container->contains($zhaoliu)); // bool(false)

// 删除指定对象
$container->detach($lisi);

// 添加一个 末尾
$container->attach($zhaoliu);

// 添加重复值
$zhaoliu1 = new Person('赵六');
$container->attach($zhaoliu1);
$container->attach($zhaoliu); // 只有这个算重复对象，会被替代
$container->attach(new Person('赵六'));

$container->rewind();
while ($container->valid()) {
    /** @var Person $person */
    $person = $container->current();
    echo $container->getHash($person) . ":{$person->name}".PHP_EOL;
    $container->next();
}
// 张三，王五，赵六，赵六，赵六

var_dump($container->count()); // int(5)