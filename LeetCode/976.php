<?php

class Solution
{

    /**
     * @param Integer[] $A
     * @return Integer
     */
    function largestPerimeter($A)
    {
        sort($A);

        for ($i = count($A) - 1; $i >= 2; --$i) {
            if ($A[$i - 2] + $A[$i - 1] > $A[$i]) {
                return $A[$i - 2] + $A[$i - 1] + $A[$i];
            }
        }

        return 0;
    }
}

$solution = new Solution();

var_dump($solution->largestPerimeter([2, 1, 2])); // 1 2 2
var_dump($solution->largestPerimeter([1, 2, 1])); // 1 1 2
var_dump($solution->largestPerimeter([3, 2, 3, 4])); // 2 3 3 4
var_dump($solution->largestPerimeter([3, 6, 2, 3])); // 2 3 3 6
