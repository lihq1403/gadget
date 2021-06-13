<?php /** @noinspection ALL */

class Process
{
    protected $pid;

    public function __construct(callable $callable, string $name = null)
    {
        $pid = pcntl_fork();
        if ($pid < 0) {
            throw new Exception(pcntl_strerror(pcntl_get_last_error(), pcntl_get_last_error()));
        } else {
            if ($pid > 0) {
                echo "[Parent] New Process {$pid}" . PHP_EOL;
                $this->pid = $pid;
            } else {
                if ($name) {
                }
                $this->pid = getmypid();
                echo sprintf("[Child %d] running" . PHP_EOL, $this->pid);
                $exitStatus = $callable();
                echo sprintf("[Child %d] exit(%d)" . PHP_EOL, $this->pid, $exitStatus);
                exit($exitStatus);
            }
        }
    }

    public function getPid(): int
    {
        return $this->pid;
    }

    public function kill(int $signal = SIGTERM): void
    {
        if (!posix_kill($this->pid, $signal)) {
            throw new Exception(sprintf("Kill(%d, %d) fail, reason: %s"), $this->getPid(), $signal, posix_strerror(posix_get_last_error()));
        }
    }

    public static function setName(string $name)
    {
        if (function_exists('cli_set_process_title') && PHP_OS_FAMILY !== 'Darwin') {
            cli_set_process_title($name);
        }
    }
}

class ProcessPool
{
    protected $pool = [];
    protected $idMap = [];
    protected $callable;
    protected $count;

    public function __construct(callable $callable, int $count)
    {
        $this->callable = $callable;
        $this->count = $count;
        Process::setName('Parent');
    }

    public function run()
    {
        for ($id = 0; $id < $this->count; $id++) {
            $this->createProcess($id);
        }

        while (true) {
            $pid = pcntl_wait($status);
            echo sprintf("[Parent] Process %s exit with status %d, signal=%d" . PHP_EOL, $pid, pcntl_wexitstatus($status), pcntl_wtermsig($status));
            unset($this->pool[$pid]);
            $id = $this->idMap[$pid];
            unset($this->idMap[$pid]);
            $this->createProcess($id);
        }
    }

    protected function createProcess(int $id)
    {
        $process = new Process($this->callable, "Child-{$id}");
        $this->pool[$process->getPid()] = $process;
        $this->idMap[$process->getPid()] = $id;
    }
}

$processPool = new ProcessPool(function () {
    sleep(mt_rand(1, 30));
}, 4);
$processPool->run();