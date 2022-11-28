<?php

$list = new SplDoublyLinkedList();

// 判断链表是否空
var_dump($list->isEmpty()); // bool(true)

// 添加新的节点到链表顶部 (top)
$list->push('2');
$list->push('3');
$list->push('4');
var_dump($list); // bottom ['2', '3', '4'] top

// 在指定索引处添加新值，如果index不存在，异常
$list->add(0, '1');
var_dump($list); // bottom ['1', '2', '3', '4'] top

// 添加新的节点到链表底部（bottom）
$list->unshift('0');
var_dump($list); // bottom ['0', '1', '2', '3', '4'] top

// 获取节点数量
$count = $list->count();
var_dump($count); // int(5)

// 获取顶部的节点
$top = $list->top();
var_dump($top); // string(1) "4"

// 获取底部的节点
$bottom = $list->bottom();
var_dump($bottom); // string(1) "0"

// 将指针重置，指向bottom节点
$list->rewind();

// 获取当前节点指针的index和value
$key = $list->key();
$value = $list->current();
var_dump("key:{$key} value:{$value}"); // string(13) "key:0 value:0"

// 移动指针到下一个
$list->next();
var_dump("key:{$list->key()} value:{$list->current()}"); // string(13) "key:1 value:1"

// 移动指针到上一个
$list->prev();
var_dump("key:{$list->key()} value:{$list->current()}"); // string(13) "key:0 value:0"

// 从top取出一个数据
$pop = $list->pop();
var_dump($pop); // string(1) "4"
var_dump($list); // bottom ['0', '1', '2', '3'] top

// 从bottom取出一个数据
$shift = $list->shift();
var_dump($shift); // string(1) "0"
var_dump($list); // bottom ['1', '2', '3'] top

// 序列化
$serialize = $list->serialize();
var_dump($serialize); // string(31) "i:0;:s:1:"1";:s:1:"2";:s:1:"3";"

// offset
var_dump($list->offsetExists(0)); // bool(true)
var_dump($list->offsetGet(0));
$list->offsetSet(2, '4');
var_dump($list); // bottom ['1', '2', '4'] top
$list->offsetUnset(2);
var_dump($list); // bottom ['1', '2'] top

// 验证当前节点是否有效
$list->rewind();
var_dump("key:{$list->key()} value:{$list->current()} valid:{$list->valid()}"); // string(21) "key:0 value:1 valid:1"
$list->next();
var_dump("key:{$list->key()} value:{$list->current()} valid:{$list->valid()}"); // string(21) "key:1 value:2 valid:1"
$list->next();
var_dump("key:{$list->key()} value:{$list->current()} valid:{$list->valid()}"); // string(19) "key:2 value: valid:"

/**
 * 迭代模式
 * - SplDoublyLinkedList::IT_MODE_LIFO 2 (堆栈 后进先出)
 * - SplDoublyLinkedList::IT_MODE_FIFO 0 (队列 先进先出 默认)
 * 迭代行为
 * - SplDoublyLinkedList::IT_MODE_DELETE (删除已迭代的节点元素)
 * - SplDoublyLinkedList::IT_MODE_KEEP (保留已迭代的节点元素 默认)
 */
$list->setIteratorMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP);
$mode = $list->getIteratorMode();
var_dump($mode); // 0

function testMode(int $mode)
{
    $list = new SplDoublyLinkedList();
    $list->setIteratorMode($mode);

    $mode = $list->getIteratorMode();
    var_dump("mode: {$mode}");

    $list->push('a');
    $list->push('b');
    $list->push('c');
    for ($list->rewind();$list->valid();$list->next()) {
        var_dump("key:{$list->key()} value:{$list->current()}");
    }
    var_dump($list);
    echo PHP_EOL;
};

// 先进先出，删除已迭代节点
testMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_DELETE);
/**
 * mode: 1
 *
 * key:0 value:a
 * key:0 value:b
 * key:0 value:c
 *
 * list: bottom [] top
 */

// 先进先出，保留已迭代节点
testMode(SplDoublyLinkedList::IT_MODE_FIFO | SplDoublyLinkedList::IT_MODE_KEEP);
/**
 * mode: 0
 *
 * key:0 value:a
 * key:1 value:b
 * key:2 value:c
 *
 * list: bottom ['a', 'b', 'c'] top
 */

// 后进先出，删除已迭代节点
testMode(SplDoublyLinkedList::IT_MODE_LIFO | SplDoublyLinkedList::IT_MODE_DELETE);
/**
 * mode: 3
 *
 * key:2 value:c
 * key:1 value:b
 * key:0 value:a
 *
 * list: bottom [] top
 */

// 后进先出，保留已迭代节点
testMode(SplDoublyLinkedList::IT_MODE_LIFO | SplDoublyLinkedList::IT_MODE_KEEP);
/**
 * mode: 2
 *
 * key:2 value:c
 * key:1 value:b
 * key:0 value:a
 *
 * list: bottom ['a', 'b', 'c'] top
 */

// 时间复杂度 O (1) 验证
$list = new SplDoublyLinkedList();
for ( $i = 0 ; $i < 2000001 ; $i++ ) {
    $list->push($i);
}

$start = microtime(true);
$list->offsetGet(0);
$end = microtime(true);
var_dump(($end - $start) *  1000); // float(0.0030994415283203125)

$start = microtime(true);
$list->offsetGet(2000000);
$end = microtime(true);
var_dump(($end - $start) *  1000); // float(3.4248828887939453)