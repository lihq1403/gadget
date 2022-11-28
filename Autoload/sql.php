<?php

/**
 * 当使用 spl_autoload_register() 后当 new 一个未包含的类时候，会去执行 spl_autoload_register() 第一个参数函数名的函数，这个函数有一个参数就是需要 new 的类名，这个函数的功能就是把这个类给包含进来（类名和文件名一致），这样就实现了自动加载功能。
 */
spl_autoload_register('autoload', true, true);
function autoload($className = ''){
    echo '类名为：' . $className . PHP_EOL;
    include "./{$className}.php";
}

$class = new Autoload();
$class->hello();