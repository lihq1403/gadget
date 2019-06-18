<?php

/**
 * 食物烹饪
 * Class Cooking
 */
class  Cooking
{
    /**
     * 选择烹饪工具
     * @var kitchenWare
     */
    protected $kitchenWare;

    /**
     * Cook constructor.
     * @param kitchenWare $kitchenWare
     */
    public function __construct(kitchenWare $kitchenWare)
    {
        $this->kitchenWare = $kitchenWare;
    }

    /**
     * 烹饪食物
     * @param Food $food
     * @return mixed
     */
    public function cooking(Food $food)
    {
        $data = $this->kitchenWare->process($food);
        return $data;
    }
}