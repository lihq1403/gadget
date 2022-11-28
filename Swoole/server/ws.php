<?php


class Ws
{
    const HOST = '0.0.0.0';
    const PORT = 8812;

    public $ws = null;

    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);

        $this->ws->set([
            'worker_num' => 2,
            'task_worker_num' => 2
        ]);

        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
        $this->ws->on('task', [$this, 'onTask']);
        $this->ws->on('finish', [$this, 'onFinish']);
        $this->ws->on('close', [$this, 'onClose']);

        $this->ws->start();
    }

    /**
     * 监听ws连接事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request)
    {
        echo "server: handshake success with fd{$request->fd}\n";

        if ($request->fd == 1) {
            // 每2秒执行
            swoole_timer_tick(2000, function ($timer_id) {
                echo "2s: timerId:{$timer_id}\n";
            });
        }
    }

    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

        // todo 10s
        $data = [
            'task' => 1,
            'fd' => $frame->fd,
        ];
//        $ws->task($data);

        swoole_timer_after(5000, function () use ($ws, $frame) {
            echo "5s-after\n";
            $ws->push($frame->fd, "server-time-after:\n");
        });


        $ws->push($frame->fd, "this is server".date("Y-m-d H:i:s"));
    }

    /**
     * @param $server
     * @param $task_id
     * @param $worker_id
     * @param $data
     * @return string
     */
    public function onTask($server, $task_id, $worker_id, $data)
    {
        print_r($data);
        // 耗时场景
        sleep(10);

        return "on task finish"; // 告诉worker
    }

    /**
     * @param $server
     * @param $task_id
     * @param $data
     */
    public function onFinish($server, $task_id, $data)
    {
        echo "taskId:{$task_id}\n";
        echo "finish-data-success:{$data}";
    }

    /**
     * @param $ws
     * @param $fd
     */
    public function onClose($ws, $fd)
    {
        echo "client-id:{$fd} close\n";
    }
}

$obj = new Ws();