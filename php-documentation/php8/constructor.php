<?php

class Point
{
    public function __construct(protected int $x, protected int $y = 0) {
    }

    public function getX(): int
    {
        return $this->x;
    }

    public function getY(): int
    {
        return $this->y;
    }
}

$point = new Point(1, 2);
var_dump($point->getX());
var_dump($point->getY());

