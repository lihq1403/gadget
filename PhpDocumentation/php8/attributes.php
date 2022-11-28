<?php

#[Attribute]
class DemoAttribute1
{
    public function __construct(public string $value)
    {
    }
}

#[Attribute]
class DemoAttribute2
{
    public function __construct(public string $value)
    {
    }
}

#[DemoAttribute1(value: 'demo1')]
#[DemoAttribute2(value: 'demo2')]
class AttributeTest
{
}

$class = new ReflectionClass(AttributeTest::class);
$attributes = $class->getAttributes();

foreach ($attributes as $attribute) {
    var_dump($attribute->getName());
    var_dump($attribute->getArguments());
}
/*
  string(14) "DemoAttribute1"
  array(1) {
    ["value"]=>
    string(5) "demo1"
  }
  string(14) "DemoAttribute2"
  array(1) {
    ["value"]=>
    string(5) "demo2"
  }
 */