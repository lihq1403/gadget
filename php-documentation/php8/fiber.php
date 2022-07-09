<?php

$fiber = new Fiber(function (int $one): int {
    $two = Fiber::suspend($one);
    $three = Fiber::suspend($two);
    $four = Fiber::suspend($three);
    $five = Fiber::suspend($four);
    return Fiber::suspend($five);
});

print $fiber->start(1) . PHP_EOL; // 1

var_dump($fiber->isRunning()); // bool(false)
var_dump($fiber->isStarted()); // bool(true)
var_dump($fiber->isSuspended()); // bool(true)
var_dump($fiber->isTerminated()); // bool(false)

print $fiber->resume(2) . PHP_EOL; // 2
print $fiber->resume(3) . PHP_EOL; // 3
print $fiber->resume(4) . PHP_EOL; // 4
print $fiber->resume(5) . PHP_EOL; // 5
print $fiber->resume(6) . PHP_EOL; //
print $fiber->getReturn() . PHP_EOL; // 6

var_dump($fiber->isTerminated()); // bool(true)