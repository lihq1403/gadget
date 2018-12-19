<?php
/**
 * 常用算法学习
 * Created by PhpStorm.
 * User: lihq
 * Date: 2018/12/18
 * Time: 15:19
 */


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