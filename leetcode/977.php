<?php

/**
 * 给你一个按 非递减顺序 排序的整数数组 nums，返回 每个数字的平方 组成的新数组，要求也按 非递减顺序 排序。
 * 输入：nums = [-4,-1,0,3,10]
输出：[0,1,9,16,100]
解释：平方后，数组变为 [16,1,0,9,100]
排序后，数组变为 [0,1,9,16,100]
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer[]
     */
    function sortedSquares(array $nums): array
    {
        foreach ($nums as &$num) {
            $num *= $num;
        }
        unset($num);
        sort($nums);
        return $nums;
    }
}

$solution = new Solution();

$nums = [-4,-1,0,3,10];
var_dump($solution->sortedSquares($nums));

$nums = [-7,-3,2,3,11];
var_dump($solution->sortedSquares($nums));