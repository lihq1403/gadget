<?php

$closure = function ($name) {
    return 'Hello ' . $name;
};
echo $closure('Lihq'); //Hello Lihq
var_dump(method_exists($closure, '__invoke')); //true
