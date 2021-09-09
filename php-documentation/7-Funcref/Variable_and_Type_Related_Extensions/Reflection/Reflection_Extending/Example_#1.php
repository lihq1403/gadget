<?php

class MyReflectionMethod extends ReflectionMethod
{
    public $visibility = [];

    public function __construct($o, $m)
    {
        parent::__construct($o, $m);
        $this->visibility = Reflection::getModifierNames($this->getModifiers());
    }
}

class T {
    protected function x(){}
}

class U extends T {
    function x(){}
}

var_dump(new MyReflectionMethod('U', 'x'));