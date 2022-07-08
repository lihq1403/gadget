<?php

class Number {
    public function __construct(private float|int $number) {}

    public function getNumber(): float|int
    {
        return $this->number;
    }
}

$number = new Number(1);
var_dump($number->getNumber()); // int(1)
$number = new Number(1.1);
var_dump($number->getNumber()); // float(1.1)