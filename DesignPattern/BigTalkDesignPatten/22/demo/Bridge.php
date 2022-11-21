<?php

/**
 * 手机软件基类
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

/**
 * 手机品牌基类
 */
abstract class HandsetBrand
{
    protected HandsetSoft $handsetSoft;

    public function setHandsetSoft(HandsetSoft $handsetSoft)
    {
        $this->handsetSoft = $handsetSoft;
    }

    abstract public function run();
}

class HandsetBrandN extends HandsetBrand
{
    public function run()
    {
        echo '手机N run'.PHP_EOL;
        $this->handsetSoft->run();
        echo PHP_EOL;
    }
}

class HandsetBrandM extends HandsetBrand
{
    public function run()
    {
        echo '手机M run'.PHP_EOL;
        $this->handsetSoft->run();
        echo PHP_EOL;
    }
}


// 初始化n手机
$n = new HandsetBrandN();
// 运行N手机的手机游戏
$n->setHandsetSoft(new HandsetGame());
$n->run();
// 运行N手机的通讯录
$n->setHandsetSoft(new HandsetAddressList());
$n->run();

// 初始化m手机
$m = new HandsetBrandM();
// 运行M手机的手机游戏
$m->setHandsetSoft(new HandsetGame());
$m->run();
// 运行M手机的通讯录
$m->setHandsetSoft(new HandsetAddressList());
$m->run();

// 这时候突然加一个mp3的手机应用，需要加一个手机应用类即可，无需改动到手机品牌

class HandsetMP3 extends HandsetSoft
{
    public function run()
    {
        echo '运行手机MP3' . PHP_EOL;
    }
}

// 运行N手机的手机MP3
$n->setHandsetSoft(new HandsetMP3());
$n->run();

// 运行M手机的手机MP3
$m->setHandsetSoft(new HandsetMP3());
$m->run();