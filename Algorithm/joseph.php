<?php

// 约瑟夫环
// 一群猴子排成一圈，按 1，2，…，n 依次编号。然后从第 1 只开始数，数到第 m 只，把它踢出圈，从它后面再开始数，再数到第 m 只，在把它踢出去…，如此不停的进行下去，直到最后只剩下一只猴子为止，那只猴子就叫做大王。要求编程模拟此过程，输入 m、n, 输出最后那个大王的编号。

function king($n , $m)
{
    // 创建1到n的数组
    $monkeys = range(1, $n);

    $i = 0;
    //循环条件为猴子数量大于1
    while (count($monkeys) > 1) {
        // $i为数组下标；$i+1为猴子标号
        if (($i + 1)%$m == 0) {
            // 余数等于0表示正好第m个，删除，用unset删除保持下标关系
            unset($monkeys[$i]);
        } else {
            // 如果余数不等于0，则把数组下标为$i的放最后，形成一个圆形结构
            array_push($monkeys, $monkeys[$i]);
            unset($monkeys[$i]);
        }
        // $i 循环+1，不断把猴子删除，或者push到数组尾
        $i++;
    }
    // 猴子数量等于1时输出猴子标号，得出猴王
    return current($monkeys);
}

echo king(100, 7);


function circle($n, $m)
{
    if ($n == 1) {
        return 1;
    }
    return (circle($n - 1, $m) + $m - 1) % $n + 1;
}

echo circle(100, 7);

function get_king_monkey($n, $m)
{
    $arr = range(1, $n);

    $i = 0;

    while (count($arr) > 1) {
        $i++;

        $sur = array_shift($arr);

        if ($i % $m != 0) {
            array_push($arr, $sur);
        }
    }

    return $arr[0];
}

echo  get_king_monkey(100, 7);