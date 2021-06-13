<?php /** @noinspection ALL */

$parentPid = getmypid();
echo '目前父进程的pid为：' . $parentPid . PHP_EOL;

$pid = pcntl_fork();

// pcntl_fork()后父进程和子进程将各自继续往下执行代码
// 上面只fork了一次，但是下面的代码会执行两次，一次在父进程里，一次在子进程里
if ($pid > 0) {
    echo '我创建了一个子进程：' . $pid . PHP_EOL;
} else if (0 === $pid) {
    echo '我是新创建的子进程' . PHP_EOL;
} else {
    echo 'fork失败' . PHP_EOL;
}