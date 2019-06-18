<?php

/**
 * Interface kitchenWare
 */
interface kitchenWare {

    /**
     * 加工食材
     * @param Food $food
     * @return mixed
     */
    public function process(Food $food);

    /**
     * 是否正在加工
     * @return mixed
     */
    public function hasProcess();
}