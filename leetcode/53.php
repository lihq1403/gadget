<?php

/**
 * 给你一个整数数组 nums ，请你找出一个具有最大和的连续子数组（子数组最少包含一个元素），返回其最大和。子数组 是数组中的一个连续部分。
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxSubArray($nums) {
        $max = $nums[0];
        $last = $nums[0];

        for ($i=1;$i<count($nums);$i++) {
            $last = max($last + $nums[$i], $nums[$i]);
            $max = max($last, $max);
        }

        return $max;
    }
}

$solution = new Solution();

$nums = [-2,1,-3,4,-1,2,1,-5,4];
var_dump($solution->maxSubArray($nums));

$nums = [1];
var_dump($solution->maxSubArray($nums));

$nums = [5,4,-1,7,8];
var_dump($solution->maxSubArray($nums));