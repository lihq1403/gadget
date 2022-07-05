<?php

$list = new SplStack();

$mode = $list->getIteratorMode();
var_dump("mode: {$mode}");

$list->push('a');
$list->push('b');
$list->push('c');

$list->rewind();
while($list->valid()){
    var_dump("key:{$list->key()} value:{$list->current()}");
    $list->next();
}
var_dump($list);
/**
 * mode: 6
 *
 * string(13) "key:2 value:c"
 * string(13) "key:1 value:b"
 * string(13) "key:0 value:a"
 *
 * list: bottom ['a', 'b', 'c'] top
 */