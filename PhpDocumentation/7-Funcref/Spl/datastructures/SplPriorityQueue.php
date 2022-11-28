<?php

$objPQ = new SplPriorityQueue();

$objPQ->insert('A',3);
$objPQ->insert('B',6);
$objPQ->insert('C',1);
$objPQ->insert('D',2);

/**
 * 设置元素出队模式
 * SplPriorityQueue::EXTR_DATA 仅提取值
 * SplPriorityQueue::EXTR_PRIORITY 仅提取优先级
 * SplPriorityQueue::EXTR_BOTH 提取数组包含值和优先级
 */
$objPQ->setExtractFlags(SplPriorityQueue::EXTR_BOTH);

$top = $objPQ->top();
var_dump($top);
//array(2) {
//    ["data"]=>
//  string(1) "B"
//    ["priority"]=>
//  int(6)
//}

while ($objPQ->valid()) {
    $current = $objPQ->extract();
    echo "data: {$current['data']} priority: {$current['priority']}" . PHP_EOL;
}

//data: B priority: 6
//data: A priority: 3
//data: D priority: 2
//data: C priority: 1
