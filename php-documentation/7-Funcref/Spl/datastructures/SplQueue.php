<?php

$list = new SplQueue();

$mode = $list->getIteratorMode();
var_dump("mode: {$mode}");

$list->enqueue('a');
$list->enqueue('b');
$list->enqueue('c');

$list->rewind();
while($list->valid()){
    var_dump("key:{$list->key()} value:{$list->current()}");
    $list->next();
}
var_dump($list);
/**
 * mode: 4
 *
 * string(13) "key:0 value:a"
 * string(13) "key:1 value:b"
 * string(13) "key:2 value:c"
 *
 * list: bottom ['a', 'b', 'c'] top
 */

//$list->dequeue();