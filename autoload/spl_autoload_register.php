<?php

$autoload1 = function (string $classname) {
    $path = './demo1/' .$classname . '.php';
    echo "尝试使用autoload1 加载类 {$classname}" .PHP_EOL;
    if (file_exists($path)) {
        require_once $path;
    }
};

$autoload2 = function (string $classname) {
    $path = './demo2/' . $classname . '.php';
    echo "尝试使用autoload2 加载类 {$classname}" .PHP_EOL;
    if (file_exists($path)) {
        require_once $path;
    }
};

spl_autoload_register($autoload1);
spl_autoload_register($autoload2);

AutoloadDemo1::hello();
AutoloadDemo2::hello();

var_dump(spl_autoload_functions());