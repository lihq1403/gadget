<?php

/**
 * 给你一个下标从 1 开始的整数数组 numbers ，该数组已按 非递减顺序排列  ，请你从数组中找出满足相加之和等于目标数 target 的两个数。如果设这两个数分别是 numbers[index1] 和 numbers[index2] ，则 1 <= index1 < index2 <= numbers.length 。

以长度为 2 的整数数组 [index1, index2] 的形式返回这两个整数的下标 index1 和 index2。

你可以假设每个输入 只对应唯一的答案 ，而且你 不可以 重复使用相同的元素。

你所设计的解决方案必须只使用常量级的额外空间。
 *
 * 输入：numbers = [2,7,11,15], target = 9
输出：[1,2]
解释：2 与 7 之和等于目标数 9 。因此 index1 = 1, index2 = 2 。返回 [1, 2] 。
 */

class Solution {

    /**
     * @param Integer[] $numbers
     * @param Integer $target
     * @return Integer[]
     */
    function twoSum($numbers, $target) {
        foreach ($numbers as $k => $v) {
            $diff = $target - $v;
            $index = array_keys($numbers, $diff);
            $index = (end($index));
            if ($index !== false) {
                return [$k+1, $index+1];
            }
        }
        return [0, 0];
    }
}

$solution = new Solution();

$numbers = [2,7,11,15];
$target = 9;
var_dump($solution->twoSum($numbers, $target));

$numbers = [2,3,4];
$target = 6;
var_dump($solution->twoSum($numbers, $target));

$numbers = [-1, 0];
$target = -1;
var_dump($solution->twoSum($numbers, $target));

$numbers = [0,0,3,4];
$target = 0;
var_dump($solution->twoSum($numbers, $target));