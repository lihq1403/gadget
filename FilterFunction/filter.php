<?php

/**
 * filter_has_var
 */

var_dump(filter_has_var(INPUT_GET, 'name')); // bool(false)

/**
 * filter_var
 */

var_dump(filter_var("1", FILTER_VALIDATE_BOOLEAN)); // bool(true)
var_dump(filter_var("yes", FILTER_VALIDATE_BOOLEAN)); // bool(true)
var_dump(filter_var("no", FILTER_VALIDATE_BOOLEAN)); // bool(false)

var_dump(filter_var("hhh@qq.com", FILTER_VALIDATE_EMAIL)); // string(10) "hhh@qq.com"
var_dump(filter_var("https://www.baidu.com", FILTER_VALIDATE_EMAIL)); // bool(false)

var_dump(filter_var("0.02", FILTER_VALIDATE_FLOAT)); // float(0.02)
var_dump(filter_var("0.02s", FILTER_VALIDATE_FLOAT)); // bool(false)
var_dump(filter_var(-0.02, FILTER_VALIDATE_FLOAT)); //float(-0.02)
var_dump(filter_var(1, FILTER_VALIDATE_FLOAT)); // float(1)

var_dump(filter_var("12", FILTER_VALIDATE_INT)); // int(12)
var_dump(filter_var("12.3", FILTER_VALIDATE_INT)); // bool(false)
var_dump(filter_var("0", FILTER_VALIDATE_INT)); // int(0)
var_dump(filter_var(-1, FILTER_VALIDATE_INT)); // ing(-1)


var_dump(filter_var("test", FILTER_VALIDATE_IP)); // bool(false)
var_dump(filter_var("127.0.0.1", FILTER_VALIDATE_IP)); // string(9) "127.0.0.1"
var_dump(filter_var("114.114.114.256", FILTER_VALIDATE_IP)); // string(9) "127.0.0.1"
var_dump(filter_var("2001:3CA1:010F:001A:121B:0000:0000:0010", FILTER_VALIDATE_IP)); // string(39) "2001:3CA1:010F:001A:121B:0000:0000:0010"

var_dump(filter_var("127.0.0.1", FILTER_VALIDATE_MAC)); // bool(false)
var_dump(filter_var("07-16-76-00-02-8F", FILTER_VALIDATE_MAC)); // string(17) "07-16-76-00-02-8F"
var_dump(filter_var("07-16-76-00-02-8G", FILTER_VALIDATE_MAC)); // bool(false)

var_dump(filter_var("Match this string", FILTER_VALIDATE_REGEXP, [
    "options" => [
        "regexp"=>"/^M(.*)/"
    ]
])); // string(17) "Match this string"

var_dump(filter_var("https://www.baidu.com", FILTER_VALIDATE_URL)); // string(21) "https://www.baidu.com"
var_dump(filter_var("ftp://www.baidu.com", FILTER_VALIDATE_URL)); //string(19) "ftp://www.baidu.com"

var_dump(filter_var('test123', FILTER_SANITIZE_NUMBER_INT)); // string(3) "123"
var_dump(filter_var("test'456", FILTER_SANITIZE_MAGIC_QUOTES)); // string(9) "test\'456"
var_dump(filter_var("<script>alert('xss')</script>", FILTER_SANITIZE_STRING)); // string(20) "alert(&#39;xss&#39;)"
