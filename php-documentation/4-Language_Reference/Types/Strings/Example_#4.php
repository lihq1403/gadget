<?php
// 静态变量
function foo()
{
    static $bar = <<<LABEL
Nothing in here...
LABEL;
}

class foo
{
    const BAR = <<<FOOBAR
Constant example
FOOBAR;

    public $baz = <<<FOOBAZ
Property example
FOOBAZ;

}