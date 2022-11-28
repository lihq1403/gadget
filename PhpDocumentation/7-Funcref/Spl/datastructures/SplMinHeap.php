<?php

$maxHeap = new SplMinHeap();

$maxHeap->insert(4);
$maxHeap->insert(8);
$maxHeap->insert(1);
$maxHeap->insert(0);

foreach ($maxHeap as $item) {
    var_dump($item);
}
