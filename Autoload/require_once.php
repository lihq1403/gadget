<?php

// 正常引入
$includeRes = require 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();

// 正常引入
$includeRes = require_once 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();

// 重复引入
$includeRes = require_once 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();