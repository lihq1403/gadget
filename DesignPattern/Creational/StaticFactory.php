<?php

/**
 * 静态工厂模式
 * 与抽象工厂模式类似，此模式用于创建一系列相关或相互依赖的对象。 『静态工厂模式』与『抽象工厂模式』的区别在于，只使用一个静态方法来创建所有类型对象， 此方法通常被命名为 factory 或 build。
 */

interface FormatterInterface
{
    public function run();
}

class FormatString implements FormatterInterface
{
    public function run()
    {
        echo 'FormatString' . PHP_EOL;
    }
}

class FormatNumber implements FormatterInterface
{
    public function run()
    {
        echo 'FormatNumber' . PHP_EOL;
    }
}

class FormatNull implements FormatterInterface
{
    public function run()
    {
        echo 'FormatNull' . PHP_EOL;
    }
}

final class StaticFactory
{
    public static function factory(string $type): FormatterInterface
    {
        switch ($type) {
            case 'number':
                return new FormatNumber();
            case 'string':
                return new FormatString();
            default:
                return new FormatNull();
        }
    }
}

$number = StaticFactory::factory('number');
$number->run();

$number = StaticFactory::factory('string');
$number->run();

$number = StaticFactory::factory('a');
$number->run();

