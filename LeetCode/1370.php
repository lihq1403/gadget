<?php

//给你一个字符串s，请你根据下面的算法重新构造字符串：
//
//从 s中选出 最小的字符，将它 接在结果字符串的后面。
//从 s剩余字符中选出最小的字符，且该字符比上一个添加的字符大，将它 接在结果字符串后面。
//重复步骤 2 ，直到你没法从 s中选择字符。
//从 s中选出 最大的字符，将它 接在结果字符串的后面。
//从 s剩余字符中选出最大的字符，且该字符比上一个添加的字符小，将它 接在结果字符串后面。
//重复步骤 5，直到你没法从 s中选择字符。
//重复步骤 1 到 6 ，直到 s中所有字符都已经被选过。
//在任何一步中，如果最小或者最大字符不止一个，你可以选择其中任意一个，并将其添加到结果字符串。
//
//请你返回将s中字符重新排序后的 结果字符串 。
//
//
//
//示例 1：
//
//输入：s = "aaaabbbbcccc"
//输出："abccbaabccba"
//解释：第一轮的步骤 1，2，3 后，结果字符串为 result = "abc"
//第一轮的步骤 4，5，6 后，结果字符串为 result = "abccba"
//第一轮结束，现在 s = "aabbcc" ，我们再次回到步骤 1
//第二轮的步骤 1，2，3 后，结果字符串为 result = "abccbaabc"
//第二轮的步骤 4，5，6 后，结果字符串为 result = "abccbaabccba"
//示例 2：
//
//输入：s = "rat"
//输出："art"
//解释：单词 "rat" 在上述算法重排序以后变成 "art"
//示例 3：
//
//输入：s = "leetcode"
//输出："cdelotee"

class Solution
{
    /**
     * @param string $s
     * @return String
     */
//    public function sortString($s)
//    {
//        // 将字符串转换为数组
//        $s = str_split($s);
//
//        $res = '';
//        while (1) {
//            $arr = array_unique($s);
//            sort($arr);
//            // 步骤123
//            while (1) {
//                if (empty($s)) {
//                    break 2;
//                }
//                if (empty($arr)) {
//                    break;
//                }
//                $min = array_shift($arr);
//                $res .= $min;
//                unset($s[array_search($min, $s)]);
//            }
//
//            $arr = array_unique($s);
//            sort($arr);
//            // 步骤456
//            while (1) {
//                if (empty($s)) {
//                    break 2;
//                }
//                if (empty($arr)) {
//                    break;
//                }
//                $max = array_pop($arr);
//                $res .= $max;
//                unset($s[array_search($max, $s)]);
//            }
//        }
//
//        return $res;
//    }

    /**
     * @param String $str
     * @return String
     */
    function sortString($str) {
        $arr = str_split($str);
        sort($arr);
        $result = ''; // 最后的结果

        do {
            $offset = 0; // 键偏移
            $lastChar = ''; // 上一个添加的字符

            foreach ($arr as $k => $v) {
                if (!$lastChar || $lastChar != $v) { // 首次添加 或者 当前字符不等于上一个添加的字符
                    $result .= $lastChar = array_splice($arr, $k - $offset, 1)[0];
                    $offset++;
                }
            }

            $arr = array_reverse($arr); // 翻转数组
        } while ($arr);

        return $result;
    }
}

$solution = new Solution();

$s = 'aaaabbbbcccc';
$result = $solution->sortString($s);
echo $result . PHP_EOL;
//
//$s = 'rat';
//$result = $solution->sortString($s);
//echo $result . PHP_EOL;
//
//$s = 'leetcode';
//$result = $solution->sortString($s);
//echo $result . PHP_EOL;
//
//$s = 'ggggggg';
//$result = $solution->sortString($s);
//echo $result . PHP_EOL;
//
//$s = 'spo';
//$result = $solution->sortString($s);
//echo $result . PHP_EOL;

