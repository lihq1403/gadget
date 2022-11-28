<?php

class Ball {
    public function down()
    {
        echo 'ball is downing' . PHP_EOL;

        // 注册钩子
        Hook::add('Man');
        Hook::add('WoMan');
        Hook::add('Child');
    }

    public function todo()
    {
        Hook::exec();
    }
}

class Hook {
    private static $hook_list = [];

    public static function add($people)
    {
        self::$hook_list[] = new $people();
    }

    public static function exec()
    {
        foreach (self::$hook_list as $people) {
            $people->act();
        }
    }
}

// 具体钩子
class Man {
    public function act()
    {
        echo 'man-act' . PHP_EOL;
    }
}

class WoMan {
    public function act()
    {
        echo 'woman-act' . PHP_EOL;
    }
}

class Child {
    public function act()
    {
        echo 'child-act' . PHP_EOL;
    }
}

$ball = new Ball();
$ball->down();
$ball->todo();