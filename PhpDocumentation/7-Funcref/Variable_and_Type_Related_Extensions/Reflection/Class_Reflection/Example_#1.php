<?php

class A {
    public $one = '';
    public $two = '';

    public function __construct()
    {
    }

    public function echoOne()
    {
        echo $this->one . PHP_EOL;
    }

    public function echoTwo()
    {
        echo $this->two . PHP_EOL;
    }
}

$a = new A();

$reflector = new ReflectionClass('A');

$properties = $reflector->getProperties();

$i = 1;

foreach ($properties as $property) {
    $a->{$property->getName()} = $i;
    $a->{"echo".ucfirst($property->getName())}();
    $i++;
}