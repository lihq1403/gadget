<?php

require_once "Cooking.php";
require_once "MicrowaveOven.php";
require_once "Food.php";
require_once "Oven.php";

define("BR", "<br>");
define("HR", "<hr>");

/**
 * 微波炉加热
 */
function micro_ware(Food $food)
{
    $cooking = new Cooking(new MicrowaveOven());
    $result = $cooking->cooking($food);
    echo $result.BR;
    $result2 = $cooking->cooking($food);
    echo $result2.BR;
}

/**
 * 烤箱烤制
 */
function oven(Food $food)
{
    $cooking = new Cooking(new Oven());
    $result =  $cooking->cooking($food);
    echo $result.BR;
    $result2 =  $cooking->cooking($food);
    echo $result2.BR;
}


// 不带壳不带皮
echo "【食物类型：不带壳不带皮】".BR;
$food1 = new Food(false, false);
micro_ware($food1);
oven($food1);
echo HR;

// 带壳不带皮
echo "【食物类型：带壳不带皮】".BR;
$food2 = new Food(true, false);
micro_ware($food2);
oven($food2);
echo HR;

// 不带壳带皮
echo "【食物类型：不带壳带皮】".BR;
$food3 = new Food(false, true);
micro_ware($food3);
oven($food3);
echo HR;

// 带壳带皮
echo "【食物类型：带壳带皮】".BR;
$food4 = new Food(true, true);
micro_ware($food4);
oven($food4);
echo HR;
