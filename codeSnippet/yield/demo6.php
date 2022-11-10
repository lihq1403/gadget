<?php
class Task {
    protected int $taskId;

    protected Generator $coroutine;

    protected ?string $sendValue = null;

    protected bool $beforeFirstYield = true;

    public function __construct(int $taskId, Generator $coroutine)
    {
        $this->taskId = $taskId;
        $this->coroutine = $coroutine;
    }

    public function getTaskId(): int
    {
        return $this->taskId;
    }

    public function setSendValue(?string $sendValue): void
    {
        $this->sendValue = $sendValue;
    }

    public function run()
    {
        if ($this->beforeFirstYield) {
            $this->beforeFirstYield = false;
            return $this->coroutine->current();
        } else {
            $returnValue = $this->coroutine->send($this->sendValue);
            $this->sendValue = null;
            return $returnValue;
        }
    }

    public function isFinished(): bool
    {
        return !$this->coroutine->valid();
    }
}

class Scheduler {
    protected int $maxTaskId = 0;

    protected array $taskMap = [];

    protected SplQueue $taskQueue;

    public function __construct()
    {
        $this->taskQueue = new SplQueue();
    }

    public function newTask(Generator $coroutine): int
    {
        $tid = ++$this->maxTaskId;
        $task = new Task($tid, $coroutine);
        $this->taskMap[$tid] = $task;
        $this->schedule($task);
        return $tid;
    }

    public function schedule(Task $task)
    {
        $this->taskQueue->enqueue($task);
    }

    public function run()
    {
        while (!$this->taskQueue->isEmpty()) {
            /** @var Task $task */
            $task = $this->taskQueue->dequeue();
            $returnVal = $task->run();
            if ($returnVal instanceof SystemCall) {
                $returnVal($task, $this);
                continue;
            }
            if ($task->isFinished()) {
                unset($this->taskMap[$task->getTaskId()]);
            } else {
                $this->schedule($task);
            }
        }
    }
}

class SystemCall {
    protected $callback;

    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    public function __invoke(Task $task, Scheduler $scheduler)
    {
        $callback = $this->callback;
        return $callback($task, $scheduler);
    }
}

function getTaskId(): SystemCall
{
    return new SystemCall(function(Task $task, Scheduler $scheduler) {
        $task->setSendValue($task->getTaskId());
        $scheduler->schedule($task);
    });
}

function task(int $max): Generator
{
    $tid = yield getTaskId();
    for ($i = 1; $i <= $max; ++$i) {
        echo "This is task $tid iteration $i.\n";
        yield;
    }
}

$scheduler = new Scheduler();
$scheduler->newTask(task(10));
$scheduler->newTask(task(5));
$scheduler->run();