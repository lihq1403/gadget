<?php

/**
 * 给定一个 n 个元素有序的（升序）整型数组 nums 和一个目标值 target  ，写一个函数搜索 nums 中的 target，如果目标值存在返回下标，否则返回 -1。
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function search($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;
        while ($left <= $right) {
            $mid = intval(($left + $right) / 2);
            $num = $nums[$mid];
            if ($num == $target) {
                return $mid;
            } elseif ($num > $target) {
                $right = $mid - 1;
            } else {
                $left = $mid + 1;
            }
        }
        return -1;
    }

    function search1($nums, $target) {
        $res = array_search($target, $nums);
        if ($res) {
            return $res;
        }
        return -1;
    }
}

$solution = new Solution();

$nums = [-1,0,3,5,9,12];
var_dump($solution->search($nums, 9));

$nums = [-1,0,3,5,9,12];
var_dump($solution->search($nums, 2));