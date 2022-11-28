<?php

class ArrayAccessObj implements ArrayAccess
{
    private $container = [];

    public function __construct()
    {
        $this->container = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
        ];
    }

    /**
     * 检查一个偏移位置是否存在.
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * 获取一个偏移位置的值
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        echo '进入offsetGet方法，参数为:' . $offset . PHP_EOL;
        return $this->container[$offset] ?? null;
    }

    /**
     * 设置一个偏移位置的值
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    /**
     * 复位一个偏移位置的值
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
}

$foo = new ArrayAccessObj();

var_dump($foo['one']); // int(1)
unset($foo['one']);
var_dump($foo['one']); // NULL
$foo['four'] = 4;
var_dump($foo['four']); // int(4)

// 类实现了ArrayAccess接口，那么这个类的对象就可以使用$foo['xxx']这种结构了。
// $foo['xxx'] 对应调用offsetGet方法。
// $foo['xxx'] = 'yyy' 对应调用offsetSet方法。
// isset($foo['xxx']) 对应调用offsetExists方法。
// unset($foo['xxx']) 对应调用offsetUnset方法。
// 仅仅是官方的代码
