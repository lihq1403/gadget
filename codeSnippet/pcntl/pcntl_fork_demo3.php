<?php /** @noinspection ALL */

for ($i = 1; $i <= 4; $i++) {
    $parentPid = getmypid();
//    echo $i.'目前父进程的pid为：' . $parentPid . PHP_EOL;
    $pid = pcntl_fork();
    if ($pid > 0) {
//        echo $i.'我创建了一个子进程：' . $pid . PHP_EOL;
    } else if (0 === $pid) {
        echo $i.'我是新创建的子进程' . PHP_EOL;
    } else {
        echo $i.'fork失败' . PHP_EOL;
    }
}