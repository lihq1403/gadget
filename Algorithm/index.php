<?php
/**
 * Created by PhpStorm.
 * User: lihq
 * Date: 2018/12/19
 * Time: 12:28
 */
define('BR', "<br>");
require_once './algorithm.php';

/**
 * 计算耗时
 * @param $start_micro_time
 * @param $end_micro_time
 * @return string
 */
function get_time_consuming($start_micro_time, $end_micro_time){
    $start_time = explode(' ', $start_micro_time);
    $end_time = explode(' ', $end_micro_time);
    $this_time = $end_time[0]+$end_time[1]-($start_time[0]+$start_time[1]);
    $this_time = number_format($this_time,20);
    return "  本次执行耗时：".$this_time."秒";
}


// 需要整理排序的数组
$sort_arr = [3,5,8,4,9,6,1,7,2];

// 冒泡排序 排序稳定，时间复杂度为 O(n2)
$start_time = microtime();
$bubble_res = bubble_sort($sort_arr);
$end_time = microtime();
echo "【冒泡排序】源数组为：[".implode(',', $sort_arr)."] 排序后：[".implode(',', $bubble_res)."]".get_time_consuming($start_time, $end_time).BR;

//快速排序 最优的情况下, 复杂度为: O(nlog2n)
$start_time = microtime();
$quick_res = quick_sort($sort_arr);
$end_time = microtime();
echo "【快速排序】源数组为：[".implode(',', $sort_arr)."] 排序后：[".implode(',', $quick_res)."]".get_time_consuming($start_time, $end_time).BR;

// 需要查找的数组与查找元素
$search_arr = [1,6,9,12,18];
$search_need_num = 18;

// 二分查找 时间复杂度为O(log2n) 数据增大n倍时，耗时增大logn倍，是比线性还要低的时间复杂度
$start_time = microtime();
$bin_search_res = bin_search($search_arr, 0, count($search_arr) - 1, $search_need_num);
$end_time = microtime();
echo "【二分查找】查找数组为：[".implode(',', $search_arr)."]". "  {$search_need_num}的位置是第".($bin_search_res + 1)."个".get_time_consuming($start_time, $end_time).BR;

// 顺序查找 时间复杂度O(n) 代表数据量增大几倍，耗时也增大几倍。比如常见的遍历算法
$start_time = microtime();
$seq_search_res = seq_search($search_arr, $search_need_num);
$end_time = microtime();
echo "【顺序查找】查找数组为：[".implode(',', $search_arr)."]". "  {$search_need_num}的位置是第".($seq_search_res + 1)."个".get_time_consuming($start_time, $end_time).BR;

/**
 * O后面的括号中有一个函数，指明某个算法的耗时/耗空间与数据增长量之间的关系。其中的n代表输入数据的量。
 * 时间复杂度为O(n)，就代表数据量增大几倍，耗时也增大几倍。比如常见的遍历算法。
再比如时间复杂度O(n^2)，就代表数据量增大n倍时，耗时增大n的平方倍，这是比线性更高的时间复杂度。比如冒泡排序，就是典型的O(n^2)的算法，对n个数排序，需要扫描n×n次。
 * O(logn)，当数据增大n倍时，耗时增大logn倍（这里的log是以2为底的，比如，当数据增大256倍时，耗时只增大8倍，是比线性还要低的时间复杂度）。二分查找就是O(logn)的算法，每找一次排除一半的可能，256个数据中查找只要找8次就可以找到目标。
 * O(nlogn)同理，就是n乘以logn，当数据增大256倍时，耗时增大256*8=2048倍。这个复杂度高于线性低于平方。归并排序就是O(nlogn)的时间复杂度。
 * O(1)就是最低的时空复杂度了，也就是耗时/耗空间与输入数据大小无关，无论输入数据增大多少倍，耗时/耗空间都不变。 哈希算法就是典型的O(1)时间复杂度，无论数据规模多大，都可以在一次计算后找到目标（不考虑冲突的话）
 */