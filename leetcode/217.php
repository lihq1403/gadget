<?php

/**
 * 给你一个整数数组 nums 。如果任一值在数组中出现 至少两次 ，返回 true ；如果数组中每个元素互不相同，返回 false 。
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @return Boolean
     */
    function containsDuplicate(array $nums): bool
    {
        return !(count(array_unique($nums)) == count($nums));
    }
}

$solution = new Solution();

$nums = [1,2,3,1];
var_dump($solution->containsDuplicate($nums));

$nums = [1,2,3,4];
var_dump($solution->containsDuplicate($nums));

$nums = [1,1,1,3,3,4,3,2,4,2];
var_dump($solution->containsDuplicate($nums));