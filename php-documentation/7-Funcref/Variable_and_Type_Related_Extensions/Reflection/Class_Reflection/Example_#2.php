<?php

final class Testing
{
    final public static function foo()
    {
        return 'foo';
    }

    public function bar()
    {
        return 'bar';
    }
}

$method = new ReflectionMethod('Testing', 'foo');
$modifiers = $method->getModifiers();
var_dump($modifiers); // 261
var_dump(implode(',', Reflection::getModifierNames($modifiers))); // final,public,static

$method = new ReflectionMethod('Testing', 'bar');
$modifiers = $method->getModifiers();
var_dump($modifiers); // 256
var_dump(implode(',', Reflection::getModifierNames($modifiers))); // public

$class = new ReflectionClass('Testing');
$modifiers = $class->getModifiers();
var_dump($modifiers); // 4
var_dump(implode(',', Reflection::getModifierNames($modifiers))); // final