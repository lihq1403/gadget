<?php

function named_params(int $a, int $b, int $c = 0, int $d = 0)
{
    echo "a:{$a} b:{$b} c:{$c} d:{$d}" . PHP_EOL;
}

named_params(1, 2, 3, 4); // a:1 b:2 c:3 d:4
named_params(a: 1, b: 2, c: 3, d: 4); // a:1 b:2 c:3 d:4
named_params(1, 2, c: 3, d: 4); // a:1 b:2 c:3 d:4

// 完全打乱顺序
named_params(d: 4, c: 3, b: 2, a: 1); // a:1 b:2 c:3 d:4

// 可选参数在必填参数前
//named_params(c: 3, d: 4, 1, 2); // PHP Fatal error:  Cannot use positional argument after named argument

