<?php


class Ws
{
    const HOST = '0.0.0.0';
    const PORT = 8812;

    public $ws = null;

    public function __construct()
    {
        $this->ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);

        $this->ws->on('open', [$this, 'onOpen']);
        $this->ws->on('message', [$this, 'onMessage']);
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
    }

    /**
     * 监听ws消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame)
    {
        echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
        $ws->push($frame->fd, "this is server".date("Y-m-d H:i:s"));
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