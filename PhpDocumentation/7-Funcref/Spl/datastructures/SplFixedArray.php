<?php

// 定义长度后，初始化的值为null。必须先建立固定长度的数组
$arr = new SplFixedArray(4);

$arr[0] = 'php';
$arr[1] = 1;
$arr[3] = 'go';
var_dump($arr); // arr[2] 为 null

foreach ($arr as $value) {
    var_dump($value);//string(3) "php",int(1),NULL,string(2) "go"
}

// 获取长度
var_dump($arr->getSize()); // int(4)

// 重新设置数组长度，如果是小于目前的，会直接舍弃掉数据，大于目前的，就初始化null的数据
$arr->setSize(6);
var_dump($arr);

// 导入一个PHP普通数组来生成SplFixedArray实例
$arr2 = ['1', '2', '5'];
$arr2 = SplFixedArray::fromArray($arr2);
var_dump($arr2);
//object(SplFixedArray)#4 (3) {
//[0]=>
//  string(1) "1"
//[1]=>
//  string(1) "2"
//[2]=>
//  string(1) "5"
//}