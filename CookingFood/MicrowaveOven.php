<?php

require_once "kitchenWare.php";

/**
 * 微波炉
 * Class MicrowaveOven
 */
class MicrowaveOven implements kitchenWare
{

    /**
     * 是否在加热
     * @var bool
     */
    protected $is_heat = false;

    /**
     *
     * @param Food $food
     * @return string
     */
    public function process(Food $food)
    {
        if ($this->hasProcess()) {
            return '已有食物在加热，无法打开';
        } else {
            if ($food->hasShuck() || $food->hasPericarp()) {
                return '食物带壳或者带皮，无法进行加热';
            } else {
                $this->is_heat = true;
                return '食物加热中，加热完成即可取出';
            }
        }
    }

    /**
     * 是否在加工
     * @return bool
     */
    public function hasProcess()
    {
        return $this->is_heat;
    }
}