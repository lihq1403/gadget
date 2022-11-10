<?php

//function yield_func0(): Generator
//{
//    $data = yield 12;
//    echo 'get yield data: ' . $data . PHP_EOL;
//}
//
//$gen = yield_func0();
//$res = $gen->current();
//echo 'current return : ' . $res . PHP_EOL;
//$gen->send(32);

//function yield_func1(): Generator
//{
//    echo 'begin' . PHP_EOL;
//    yield;
//    echo 'end' . PHP_EOL;
//}
//
//$gen = yield_func1();
//$gen->current();
//echo 'current' . PHP_EOL;
//$gen->next();

//function yield_func2(): Generator
//{
//    echo 'run to code line: ' . __LINE__ . PHP_EOL;
//    $result = yield 12;
//    echo 'run to code line: ' . __LINE__ . PHP_EOL;
//}
//
//$gen = yield_func2();
//echo 'call yield_func rewind ' . PHP_EOL;
//$gen->rewind();

//function yield_func3(): Generator
//{
//    try {
//        $re = yield 'exception';
//    } catch (Exception $e) {
//        echo 'catch exception msg: ' .$e->getMessage();
//    }
//    return 'ok';
//}
//
//$gen = yield_func3();
//$gen->throw(new \Exception('new yield exception'));

//function yield_func4(): Generator
//{
//    echo 'begin' . PHP_EOL;
//    yield;
//    echo 'end' . PHP_EOL;
//}
//
//$gen = yield_func4();
//var_dump($gen->valid());
//$gen->current();
//echo 'current' . PHP_EOL;
//var_dump($gen->valid());
//$gen->next();
//var_dump($gen->valid());

//function yield_func5(): Generator
//{
//    yield 1 => 'abc';
//}
//
//$gen = yield_func5();
//echo 'value is :' . $gen->current() . PHP_EOL;
//echo 'key is: ' . $gen->key() . PHP_EOL;

function yield_func6(): int|Generator
{
    yield 1 => 'abc';
    return 32;
}

$gen = yield_func6();
$gen->send(0);
echo 'call yield_func return, and get: ' . $gen->getReturn() . PHP_EOL;