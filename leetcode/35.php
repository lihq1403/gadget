<?php

/**
 * 给定一个排序数组和一个目标值，在数组中找到目标值，并返回其索引。如果目标值不存在于数组中，返回它将会被按顺序插入的位置。请必须使用时间复杂度为 O(log n) 的算法。
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer
     */
    function searchInsert($nums, $target) {
        $left = 0;
        $right = count($nums) - 1;
        while ($left <= $right) {
            $mid = intval($left + ($right - $left) / 2);
            $num = $nums[$mid];
            if ($num < $target) {
                $left = $mid + 1;
            } else {
                $right = $mid -1;
            }
        }
        return $left;
    }
}

$solution = new Solution();

$nums = [1,3,5,6];
var_dump($solution->searchInsert($nums, 5));
var_dump($solution->searchInsert($nums, 2));
var_dump($solution->searchInsert($nums, 7));