<?php

// 给你四个坐标点，判断它们能不能组成一个矩形，如判断([0,0],[0,1],[1,1],[1,0])能组成一个矩形。

// 根据坐标点，列出所有的两点组合边长的数组，去重，看是不是只剩 3个长度（注意正方形2个长度）,判断是否满足勾股定理

// 矩形有4条边，两两相等， 矩形两条对角线相等， 矩形的长短边与对角线满足勾股定理

function isRectangle($point1, $point2, $point3, $point4)
{
    if ($point1 == $point2 || $point1 == $point3  || $point1 == $point4 || $point2 == $point3 || $point2 == $point4 || $point3 == $point4) {
        return false;
    }

    $lengthArr = [];
    $lengthArr[] = getLengthSquare($point1, $point2);
    $lengthArr[] = getLengthSquare($point1, $point3);
    $lengthArr[] = getLengthSquare($point1, $point4);
    $lengthArr[] = getLengthSquare($point2, $point3);
    $lengthArr[] = getLengthSquare($point2, $point4);
    $lengthArr[] = getLengthSquare($point3, $point4);

    $lengthArr = array_unique($lengthArr);

    $lengthCount = count($lengthArr);
    if ($lengthCount == 3 || $lengthCount == 2) {
        if ($lengthCount == 2) {
            return max($lengthArr) == 2*min($lengthArr);
        } else {
            $maxLength = max($lengthArr);
            $minLength = min($lengthArr);
            $otherLength = array_diff($lengthArr, [$maxLength, $minLength]);
            return ($minLength + $otherLength) == $maxLength;
        }
    } else {
        return false;
    }
}


function getLengthSquare($point1, $point2)
{
    return pow($point1[0] - $point2[0], 2) + pow($point1[1] - $point2[1], 2);
}

var_dump(isRectangle([0,0],[0,2],[2,2],[2,0]));