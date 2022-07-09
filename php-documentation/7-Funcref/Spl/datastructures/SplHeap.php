<?php

class MySplHeap extends SplHeap
{
    /**
     * 比较$value1是否大于$value2，如果大于为 正整数，等于为 0，小于为 负整数
     * 通过比较结果来决定在堆中的位置
     */
    protected function compare($value1, $value2): int
    {
//        return ($value1 - $value2); // 最大堆
        return ($value2 - $value1); // 最小堆
    }
}

$heap = new MySplHeap();

$heap->insert(10);
$heap->insert(14);
$heap->insert(25);
$heap->insert(33);
$heap->insert(81);
$heap->insert(82);
$heap->insert(99);

//var_dump($heap); // [10， 14， 25， 33， 81， 82， 99]
/**
 *     10
    14    25
  33 81  82 99
 */

// 获取节点数量
$count = $heap->count();
var_dump($count); // int(7)

// current 始终等于 top，所以rewind没什么用

// 获取顶部节点
$top = $heap->top();
var_dump($top); // int(10)

// 获取当前节点
$current = $heap->current();
var_dump($current); // int(10)

// 下一个节点，这里会删除掉当前节点后，指向top， 重置堆
$heap->next();
var_dump($heap->count()); // int(6)
var_dump($heap->current()); // int(14)

// 把最末端的一个节点置顶后，重新下序
//var_dump($heap); // [14， 33， 25， 99， 81， 82]

// 等同于 current + next，弹出top节点
$extract = $heap->extract();
var_dump($extract); // int(14)

// var_dump($heap); // [25, 33, 82, 99, 81]

while ($heap->valid()) {
    var_dump($heap->extract());
}
/**
 * int(25)
 * int(33)
 * int(81)
 * int(82)
 * int(99)
 */

// 获取数量
$count = $heap->count();
var_dump($count); // int(0)