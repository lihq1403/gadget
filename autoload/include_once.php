<?php

// 正常引入
$includeRes = include 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();

// 正常引入
//$includeRes = include_once 'AutoloadDemo.php';
//var_dump($includeRes);
//AutoloadDemo::hello();

// 重复引入
$includeRes = include_once 'AutoloadDemo.php';
var_dump($includeRes);
AutoloadDemo::hello();
