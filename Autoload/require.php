<?php

// 正常引入
$includeRes = require 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();

// 错误引入
$includeRes = require 'AutoloadDemo1.php';
var_dump($includeRes);

// 重复引入
$includeRes = require 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();