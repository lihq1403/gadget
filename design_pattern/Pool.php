<?php

/**
 * 对象池模式
 * 对象池可以用于构造并且存放一系列的对象并在需要时获取调用
 * 对象池模式在需要耗时创建对象方面，例如创建数据库连接，套接字连接，线程和大型图形对象（比方字体或位图等），使用起来都是大有裨益的。在某些情况下，简单的对象池（无外部资源，只占内存）可能效率不高，甚至会有损性能。
 * 对象池模式是一种提前准备了一组已经初始化了的对象『池』而不是按需创建或者销毁的创建型设计模式。对象池的客户端会向对象池中请求一个对象，然后使用这个返回的对象执行相关操作。当客户端使用完毕，它将把这个特定类型的工厂对象返回给对象池，而不是销毁掉这个对象。
 *
 对象池用来管理对象缓存。对象池是一组已经初始化过且可以直接使用的对象集合，需要使用对象时不是直接new，而是从对象池中取出，如果对象池中没有空闲对象，则新建一个空闲对象，并在不需要时重新放进对象池而非销毁。

如果对象实例化的代价高且经常需要实例化，但每次实例化的数量较少的情况下，使用对象池可以获得显著的性能提升。对象池技术的使用非常广泛，例如线程池、数据库连接池、任务队列池、图片资源对象池等。
 */

class StringReverseWorker
{
    public function __construct()
    {
    }

    public function run($text){
        return strrev($text);
    }
}

class WorkerPool implements Countable
{
    /**
     * @var array
     */
    private $occupiedWorkers = [];

    /**
     * @var array
     */
    private $freeWorkers = [];

    public function get()
    {
        if (count($this->freeWorkers) == 0) {
            $worker = new StringReverseWorker();
        } else {
            $worker = array_pop($this->freeWorkers);
        }

        $this->occupiedWorkers[spl_object_hash($worker)] = $worker;

        return $worker;
    }

    public function dispose(StringReverseWorker $worker)
    {
        $key = spl_object_hash($worker);

        if (isset($this->occupiedWorkers[$key])) {
            unset($this->occupiedWorkers[$key]);
            $this->freeWorkers[$key] = $worker;
        }
    }

    public function count()
    {
        return count($this->occupiedWorkers) + count($this->freeWorkers);
    }
}

$workerPoll = new WorkerPool();
$stringReverseWorker1 = $workerPoll->get();
$stringReverseWorker2 = $workerPoll->get();
echo $stringReverseWorker1->run('test');
echo $workerPoll->count(); // 2
$workerPoll->dispose($stringReverseWorker1);
echo $workerPoll->count(); // 2