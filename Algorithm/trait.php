<?php

trait Demo1
{
    public function test()
    {
        return __METHOD__;
    }
}

trait Demo2
{
    public function test()
    {
        return __METHOD__;
    }
}

class Demo0
{
    public function test()
    {
        return __METHOD__;
    }
}

class Demo extends Demo0
{
    use Demo1,Demo2{
        Demo1::test insteadof Demo2;
        Demo2::test as demo2test;
    }
}

$obj = new Demo();
echo $obj->test(); // Demo1::test
echo $obj->demo2test(); // Demo2::test

// trait ,当前类,父类优先级: 当前类方法 > trait 的方法 > 父类的方法

// 如果当前类引用了两个 trait, 并且这两个 trait 中有同名方法,则会报错, 可以使用 insteadof 指定使用哪个trait的方法, 此外还可以用 as 来设置别名, 从而供当前类使用