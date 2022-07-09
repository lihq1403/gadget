<?php

interface LoggerInterface
{
    public function log(string $message): void;
}

class NullLogger implements LoggerInterface
{
    public function log(string $message): void
    {
        // 什么也不用做
    }
}

class EchoLogger implements LoggerInterface
{
    public function log(string $message): void
    {
       echo $message . PHP_EOL;
    }
}

class Service
{
    public function __construct(
        protected LoggerInterface $logger = new NullLogger(),
    ) {
    }

    public function run()
    {
        $this->logger->log('run');
    }
}

$service1 = new Service();
$service1->run(); //

$service2 = new Service(new EchoLogger());
$service2->run(); // run