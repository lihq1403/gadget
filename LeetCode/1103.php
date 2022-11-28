<?php

/**
排排坐，分糖果。

我们买了一些糖果 candies，打算把它们分给排好队的 n = num_people 个小朋友。

给第一个小朋友 1 颗糖果，第二个小朋友 2 颗，依此类推，直到给最后一个小朋友 n 颗糖果。

然后，我们再回到队伍的起点，给第一个小朋友 n + 1 颗糖果，第二个小朋友 n + 2 颗，依此类推，直到给最后一个小朋友 2 * n 颗糖果。

重复上述过程（每次都比上一次多给出一颗糖果，当到达队伍终点后再次从队伍起点开始），直到我们分完所有的糖果。注意，就算我们手中的剩下糖果数不够（不比前一次发出的糖果多），这些糖果也会全部发给当前的小朋友。

返回一个长度为 num_people、元素之和为 candies 的数组，以表示糖果的最终分发情况（即 ans[i] 表示第 i 个小朋友分到的糖果数）。

 

示例 1：

输入：candies = 7, num_people = 4
输出：[1,2,3,1]
解释：
第一次，ans[0] += 1，数组变为 [1,0,0,0]。
第二次，ans[1] += 2，数组变为 [1,2,0,0]。
第三次，ans[2] += 3，数组变为 [1,2,3,0]。
第四次，ans[3] += 1（因为此时只剩下 1 颗糖果），最终数组变为 [1,2,3,1]。
示例 2：

输入：candies = 10, num_people = 3
输出：[5,2,3]
解释：
第一次，ans[0] += 1，数组变为 [1,0,0]。
第二次，ans[1] += 2，数组变为 [1,2,0]。
第三次，ans[2] += 3，数组变为 [1,2,3]。
第四次，ans[0] += 4，最终数组变为 [5,2,3]。

来源：力扣（LeetCode）
链接：https://leetcode-cn.com/problems/distribute-candies-to-people
著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */

/**
 * 我的解
 * Class Solution
 */
class Solution {

    /**
     * @param Integer $candies
     * @param Integer $num_people
     * @return Integer[]
     */
    function distributeCandies($candies, $num_people) {
        // 初始值
        $user_candies = array_fill(0, $num_people, 0); // [0,0,0,0]
        // 循环轮数
        $round = 0;

        while(1) {

            for($i=0;$i<$num_people;$i++) {
                // 当前需要分配的糖个数
                $now_candies = $num_people * $round + $i + 1;

                // 剩余糖
                $candies -= $now_candies;

                // 如果剩余糖不够分了，则全给当前人
                if ($candies <= 0) {
                    $user_candies[$i] += $candies + $now_candies;
                    break 2;
                }
                $user_candies[$i] += $now_candies;
            }
            $round++;
        }
        return $user_candies;
    }
}

$solution = new Solution();
$arr = $solution->distributeCandies(10, 3);
echo '['.implode(',',$arr).']';

/**
 * 暴力循环
 * Class Solution1
 */
class Solution1 {
    /**
     * @param Integer $candies
     * @param Integer $num_people
     * @return Integer[]
     */
    function distributeCandies($candies, $num_people) {
        // 初始值
        $user_candies = array_fill(0, $num_people, 0); // [0,0,0,0]
        // 循环轮数
        $i = 0;

        while($candies > 0) {

            // 本轮分糖数
            $now_candies = min($i + 1, $candies);

            $user_candies[$i%$num_people] += $now_candies;

            $candies -= $now_candies;

            $i += 1;
        }
        return $user_candies;
    }
}

$solution1 = new Solution1();
$arr = $solution1->distributeCandies(10, 3);
echo '['.implode(',',$arr).']';

/**
 * 用时最短
 * Class Solution2
 */
class Solution2 {
    /**
     * @param Integer $candies
     * @param Integer $num_people
     * @return Integer[]
     */
    function distributeCandies($candies, $num_people) {
        $data = array_fill(0, $num_people, 0);
        $n    = 0;
        $l    = 0;
        while ($candies > 0) {
            $l++;

            $l = min($candies, $l);

            $candies -= $l;

            $data[$n] += $l;

            $n = $n >= $num_people - 1 ? 0 : $n + 1;
        }
        return $data;
    }
}

$solution2 = new Solution2();
$arr = $solution2->distributeCandies(10, 3);
echo '['.implode(',',$arr).']';