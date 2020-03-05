<?php

/**
1. 两数之和
给定一个整数数组 nums 和一个目标值 target，请你在该数组中找出和为目标值的那 两个 整数，并返回他们的数组下标。

你可以假设每种输入只会对应一个答案。但是，你不能重复利用这个数组中同样的元素。

示例:

给定 nums = [2, 7, 11, 15], target = 9

因为 nums[0] + nums[1] = 2 + 7 = 9
所以返回 [0, 1]
 */

/**
 * 我的解
 * Class Solution
 */
class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($nums, $target) {
        $result = [];
        while (!empty($nums)) {
            // 获取最小数
            $min = min($nums);
            $min_index = array_search($min, $nums);
            // 去掉当前最小数
            unset($nums[$min_index]);

            // 另一个数
            $other = $target - $min;
            $other_index = array_search($other, $nums);
            if ($other_index !== false) {
                return [$min_index, $other_index];
            }
        }
        return $result;
    }
}

$nums = [3,-3,4,-1, 0];
$target = -1;

$solution = new Solution();
$res = $solution->twoSum($nums, $target);
echo '['.implode(',', $res).']';