<?php

/**
 * 食物类
 * Class Food
 */
class Food
{
    /**
     * 是否带壳
     * @var bool
     */
    protected $is_shuck = false;

    /**
     * 是否带皮
     * @var bool
     */
    protected $is_pericarp = false;

    /**
     * Food constructor.
     * @param bool $is_shuck
     * @param bool $is_pericarp
     */
    public function __construct($is_shuck, $is_pericarp)
    {
        $this->is_shuck = $is_shuck;
        $this->is_pericarp = $is_pericarp;
    }

    /**
     * 判断是否带壳
     * @return bool
     */
    public function hasShuck()
    {
        return $this->is_shuck;
    }

    /**
     * 判断是否带皮
     * @return bool
     */
    public function hasPericarp()
    {
        return $this->is_pericarp;
    }
}