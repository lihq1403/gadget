<?php

abstract class Operation
{
    public function __construct(public string $numberA = '', public string $numberB = '', protected int $scale = 2)
    {
    }

    abstract function getResult(): string;
}

class OperationAdd extends Operation
{
    function getResult(): string
    {
        return bcadd($this->numberA, $this->numberB, $this->scale);
    }
}

class OperationSub extends Operation
{
    function getResult(): string
    {
        return bcsub($this->numberA, $this->numberB, $this->scale);
    }
}

class OperationMul extends Operation
{
    function getResult(): string
    {
        return bcmul($this->numberA, $this->numberB, $this->scale);
    }
}

class OperationDiv extends Operation
{
    function getResult(): string
    {
        if ($this->numberB == 0) {
            throw new Exception('除数不能为0');
        }
        return bcdiv($this->numberA, $this->numberB, $this->scale);
    }
}

class OperationFactory
{
    public static function createOperate(string $operate): ?Operation
    {
        return match ($operate) {
            "+" => new OperationAdd(),
            "-" => new OperationSub(),
            "*" => new OperationMul(),
            "/" => new OperationDiv(),
            default => null,
        };
    }
}

$operation = OperationFactory::createOperate('+');
$operation->numberA = '1';
$operation->numberB = '2';
var_dump($operation->getResult());