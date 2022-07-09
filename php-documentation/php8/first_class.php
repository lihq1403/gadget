<?php

//$fn = Closure::fromCallable('strlen');
$fn = strlen(...);
var_dump($fn('yes')); // int(3)

class Demo
{
    public function method(string $key)
    {
        var_dump(__FUNCTION__.":{$key}");
    }

    public static function staticMethod(string $key)
    {
        var_dump(__FUNCTION__.":{$key}");
    }

    public function run(){
//        $fn = Closure::fromCallable([$this, 'method']);
        $fn = $this->method(...);
        $fn('run');
    }
}
(new Demo())->run(); // string(10) "method:run"


//$fn = Closure::fromCallable([Demo::class, 'staticMethod']);
$fn = Demo::staticMethod(...);
$fn('run'); // string(16) "staticMethod:run"