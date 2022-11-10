<?php

/**
 * 给定一个数组 nums，编写一个函数将所有 0 移动到数组的末尾，同时保持非零元素的相对顺序。

请注意 ，必须在不复制数组的情况下原地对数组进行操作。
 *
 * 输入: nums = [0,1,0,3,12]
输出: [1,3,12,0,0]
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @return NULL
     */
    function moveZeroes(&$nums) {
        $keys = array_keys($nums, 0);
        foreach ($keys as $key) {
            unset($nums[$key]);
            $nums[] = 0;
        }
    }
}

$solution = new Solution();

$nums = [0,1,0,3,12];
$solution->moveZeroes($nums);
var_dump($nums);

$nums = [0];
$solution->moveZeroes($nums);
var_dump($nums);