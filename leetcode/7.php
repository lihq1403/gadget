<?php

class Solution {

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse($x) {
        $ans = 0;
        $maxValue = pow(2, 31) - 1;
        $minValue = pow(-2, 31);

        while ($x != 0) {
            $pop = $x % 10;
            $x = intval($x/10);
            $ans = $ans * 10 + $pop;
        }

        if ($ans > $maxValue || $ans < $minValue) {
            return 0;
        }

        return $ans;
    }
}

class Solution1 {

    /**
     * @param Integer $x
     * @return Integer
     */
    function reverse($x) {
        $max = pow(2, 31);
        $s = intval(strrev(abs($x)));
        return $x>=0?($s+1>$max?0:$s):($s>$max?0:'-'.$s);
    }
}

$solution = new Solution();

var_dump($solution->reverse(123));
var_dump($solution->reverse(-123));
var_dump($solution->reverse(120));
var_dump($solution->reverse(0));
var_dump($solution->reverse(232));
var_dump($solution->reverse(900000));
var_dump($solution->reverse(1534236469));