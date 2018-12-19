<?php
/**
 * 常用算法学习
 * Created by PhpStorm.
 * User: lihq
 * Date: 2018/12/18
 * Time: 15:19
 */


/**
 * 冒泡排序, 不断比较，将最小的放到第一个
 * 对于一个长度为N的数组，我们需要排序 N-1 轮，每 i 轮 要比较 N-i 次
 * @param $arr
 * @return mixed
 */
function bubble_sort($arr){
    $count = count($arr);
    for ($i=0;$i<$count;$i++){
        for ($j=$count-1;$j>$i;$j--){
            if ($arr[$j] < $arr[$j-1]){
                $tmp = $arr[$j];
                $arr[$j] = $arr[$j-1];
                $arr[$j-1] = $tmp;
            }
        }
    }
    return $arr;
}

/**
 * 快速排序
 * @param $arr
 * @return array
 */
function quick_sort($arr){
    $count = count($arr);
    if ($count<=1){
        return $arr;
    }
    $key = $arr[0];
    $left_arr = [];
    $right_arr = [];
    for ($i=1;$i<$count;$i++){
        if ($arr[$i] <= $key){
            $left_arr[] = $arr[$i];
        } else {
            $right_arr[] = $arr[$i];
        }
    }
    $left_arr = quick_sort($left_arr);
    $right_arr = quick_sort($right_arr);
    return array_merge($left_arr, [$key], $right_arr);
}


/**
 * 二分查找
 * @param $array | 需要查找的数组
 * @param $low | 数组起始元素下标
 * @param $high | 数组末尾元素下标
 * @param $k | 要查找的元素
 * @return int
 */
function bin_search($array, $low, $high, $k){
    if ($low <= $high){
        $mid = intval(($low + $high) / 2);
        if ($array[$mid] == $k){
            return $mid;
        } elseif ($k < $array[$mid]){
            return bin_search($array, $low, $mid - 1, $k);
        } else{
            return bin_search($array, $mid + 1, $high, $k);
        }
    }
    return -1;
}

/**
 * 顺序查找
 * @param $array
 * @param $k
 * @return int
 */
function seq_search($array, $k){
    $n = count($array);
    for ($i = 0; $i < $n; $i++){
        if ($array[$i] == $k){
            break;
        }
    }
    if ($i < $n){
        return $i;
    } else {
        return -1;
    }
}