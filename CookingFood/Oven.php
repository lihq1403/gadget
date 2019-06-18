<?php

require_once "kitchenWare.php";

/**
 * 烤箱
 * Class Oven
 */
class Oven implements kitchenWare
{
    /**
     * 是否烧烤中
     * @var bool
     */
    protected $is_heat = false;

    /**
     * 是否正在加工
     * @return bool|mixed
     */
    public function hasProcess()
    {
        return $this->is_heat;
    }

    public function process(Food $food)
    {
        if ($this->is_heat) {
            return '已有食物在烤制，无法打开';
        } else {
            if ($food->hasShuck()) {
                return '食物带壳，无法进行烤制';
            }else {
                $this->is_heat = true;
                return '食物烤制中，完成即可取出';
            }
        }
    }
}