<?php

class Testing
{
    const A = 'a';

    static $b = 'b';

    protected $c;

    final public static function foo()
    {
        return 'foo';
    }

    public function bar()
    {
        return 'bar';
    }
}

$class = new ReflectionClass('Testing');


var_dump(Reflection::export($class));
var_dump(Reflection::export($class, true));