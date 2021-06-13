<?php /** @noinspection ALL */

$parentPid = getmypid();
echo '目前父进程的pid为：' . $parentPid . PHP_EOL;

// 初始化一个number变量 1
$number = 1;
$pid = pcntl_fork();

// pcntl_fork()后父进程和子进程将各自继续往下执行代码
// 上面只fork了一次，但是下面的代码会执行两次，一次在父进程里，一次在子进程里
if ($pid > 0) {
    $number += 1;
    echo '我创建了一个子进程：' . $pid . PHP_EOL;
    echo 'number+1 :' . $number . PHP_EOL;
} else if (0 === $pid) {
    $number += 2;
    echo '我是新创建的子进程' . PHP_EOL;
    echo 'number+2 :' . $number . PHP_EOL;
} else {
    echo 'fork失败' . PHP_EOL;
}