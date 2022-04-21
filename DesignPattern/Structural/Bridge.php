<?php

/**
 * 桥梁模式
 * 所以桥梁模式的用意是“将抽象化与实现化脱耦，使得二者可以独立地变化。”
 *
 * 这是具有一般性的桥梁模式的类图，我们可以看到桥梁模式一共有四部分组成：
抽象化角色：抽象化给出的定义，并保存一个对实现化对象的引用，就是图像类中的形状父类。
修正抽象化角色：扩展抽象化角色，改变和修正父类对抽象化的定义，比如形状下有正方形，圆形等图形。
实现化角色：这个角色给出具体角色的接口，但是不给出具体的实现，这个接口不一定和抽象化角色的接口定义相同，实际上两者可以完全不一样，好比形状的颜色接口。
具体实现化角色：这个角色给出实现化角色接口的具体实现，好比各种具体的颜色。
 */

abstract class HandsetSoft
{
    abstract public function run();
}

class HandsetGame extends HandsetSoft
{
    public function run()
    {
        echo '运行手机游戏' . PHP_EOL;
    }
}

class HandsetAddressList extends HandsetSoft
{
    public function run()
    {
        echo '运行手机通讯录' . PHP_EOL;
    }
}

abstract class HandsetBrand
{
    protected HandsetSoft $soft;

    public function setHandsetSoft(HandsetSoft $soft)
    {
        $this->soft = $soft;
    }

    abstract public function run();
}

class HandsetBrandN extends HandsetBrand
{
    public function run()
    {
        $this->soft->run();
    }
}

class HandsetBrandM extends HandsetBrand
{
    public function run()
    {
        $this->soft->run();
    }
}

// 客户端调用代码

$ab = new HandsetBrandN();
$ab->setHandsetSoft(new HandsetGame());
$ab->run();

$ab->setHandsetSoft(new HandsetAddressList());
$ab->run();

$ab = new HandsetBrandM();
$ab->setHandsetSoft(new HandsetGame());
$ab->run();

$ab->setHandsetSoft(new HandsetAddressList());
$ab->run();
