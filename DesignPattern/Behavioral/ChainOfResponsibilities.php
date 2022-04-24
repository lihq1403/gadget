<?php

/**
 * 职责链模式， 使多个对象都有机会处理请求，从而避免请求的发送者和接受者之间的耦合关系。将这个对象连成一条链，并沿着这条链传递该请求，直到有一个对像处理它为止。
 */


abstract class Handler
{
    protected ?Handler $successor = null;

    public function setSuccessor(Handler $successor)
    {
        $this->successor = $successor;
    }

    abstract public function handleRequest(int $request);
}

class ConcreteHandler1 extends Handler
{
    public function handleRequest(int $request)
    {
        if ($request >= 0 && $request < 10) {
            echo "ConcreteHandler1 handle it [{$request}]" . PHP_EOL;
        } else {
            ! is_null($this->successor) && $this->successor->handleRequest($request);
        }
    }
}

class ConcreteHandler2 extends Handler
{
    public function handleRequest(int $request)
    {
        if ($request >= 10 && $request < 20) {
            echo "ConcreteHandler2 handle it [{$request}]" . PHP_EOL;
        } else {
            ! is_null($this->successor) && $this->successor->handleRequest($request);
        }
    }
}

$h1 = new ConcreteHandler1();
$h2 = new ConcreteHandler2();

$h1->setSuccessor($h2);

$requests = [1, 5, 7, 16, 25];
foreach ($requests as $request) {
    $h1->handleRequest($request);
}
