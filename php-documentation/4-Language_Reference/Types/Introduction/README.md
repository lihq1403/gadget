## 简介

PHP 支持 9 种原始数据类型。

四种标量类型：
- boolean（布尔型）
- integer（整型）
- float（浮点型，也称作 double)
- string（字符串）

三种复合类型：
- array（数组）
- object（对象）
- callable（可调用）

最后是两种特殊类型：
- resource（资源）
- NULL（无类型）

为了确保代码的易读性，本手册还介绍了一些伪类型：
- mixed（混合类型）
- number（数字类型）
- callback（回调类型，又称为 callable）
- array|object（数组 | 对象类型）
- void （无类型）
- 以及伪变量 $...。

可能还会读到一些关于“双精度（double）”类型的参考。实际上 double 和 float 是相同的，由于一些历史的原因，这两个名称同时存在。

变量的类型通常不是由程序员设定的，确切地说，是由 PHP 根据该变量使用的上下文在运行时决定的。

Note: 如果想查看某个表达式的值和类型，用 var_dump() 函数。

如果只是想得到一个易读懂的类型的表达方式用于调试，用 gettype() 函数。要检验某个类型，不要用 gettype()，而用 is_type 函数。以下是一些范例：

```php
<?php
$a_bool = TRUE;   // 布尔值 boolean
$a_str  = "foo";  // 字符串 string
$a_str2 = 'foo';  // 字符串 string
$an_int = 12;     // 整型 integer

echo gettype($a_bool); // 输出:  boolean
echo gettype($a_str);  // 输出:  string

// 如果是整型，就加上 4
if (is_int($an_int)) {
    $an_int += 4;
}

// 如果 $bool 是字符串，就打印出来
// (啥也没打印出来)
if (is_string($a_bool)) {
    echo "String: $a_bool";
}
?>
```

如果要将一个变量强制转换为某类型，可以对其使用强制转换或者 settype() 函数。

注意变量根据其当时的类型在特定场合下会表现出不同的值。更多信息见类型转换的判别。此外，还可以参考 PHP 类型比较表看不同类型相互比较的例子。