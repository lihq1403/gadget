<?php /** @noinspection ALL */

define('PROCESS_COUNT', 4);

$pidMap = [];

while (true) {
    $pid = pcntl_fork();
    if ($pid < 0) {
        echo "[Parent] Fork failed" . PHP_EOL;
        exit(1);
    } elseif ($pid > 0) {
        // 记录创建的子进程数
        $pidMap[$pid] = true;
        echo "[Parent] New Process {$pid}" . PHP_EOL;
        if (count($pidMap) === PROCESS_COUNT) {
            // 如果进程数达到最大值，进行子进程等等，并回收
            $pid = pcntl_wait($status);
            echo sprintf("[Parent] Process %s exit with status %d, signal=%d" . PHP_EOL, $pid, pcntl_wexitstatus($status), pcntl_wtermsig($status));
            unset($pidMap[$pid]);
        }
    } else {
        echo sprintf("[Child %d] running" . PHP_EOL, getmypid());
        sleep(mt_rand(1, 30));
        echo sprintf("[Child %d] exit(%d)" . PHP_EOL, getmygid(), $exStatus = mt_rand(0, 255));
        exit($exStatus);
    }
}