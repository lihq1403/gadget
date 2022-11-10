<?php

/**
 * 给你一个数组，将数组中的元素向右轮转 k 个位置，其中 k 是非负数。
 * 输入: nums = [1,2,3,4,5,6,7], k = 3
输出: [5,6,7,1,2,3,4]
解释:
向右轮转 1 步: [7,1,2,3,4,5,6]
向右轮转 2 步: [6,7,1,2,3,4,5]
向右轮转 3 步: [5,6,7,1,2,3,4]
 */

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return NULL
     */
    function rotate(array &$nums, int $k) {
        $k = $k % count($nums);

        $list = array_slice($nums, -$k, $k);
        array_splice($nums, -$k, $k);
        array_splice($nums, 0, 0, $list);
    }
}

$solution = new Solution();

$nums = [1, 2, 3, 4, 5, 6, 7];
$solution->rotate($nums, 3);
var_dump($nums);

$nums = [-1,-100,3,99];
$solution->rotate($nums, 2);
var_dump($nums);


