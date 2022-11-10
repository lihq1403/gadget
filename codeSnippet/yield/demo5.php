<?php
function gen(): Generator
{
    $ret = yield 'yield1';
    var_dump($ret);
    $ret = yield 'yield2';
    var_dump($ret);
}

$gen = gen();
$gen->rewind();
var_dump($gen->current());

var_dump($gen->send('ret1'));
var_dump($gen->send('ret2'));