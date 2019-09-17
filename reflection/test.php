<?php

class Person
{
    public $name;
    public $age;

    public function say()
    {
        echo $this->name . PHP_EOL . $this->age;
    }

    public function set($name, $value)
    {
        echo 'set name to value';
        $this->$name = $value;
    }

    public function get($name)
    {
        if (!isset($this->$name)) {
            echo 'unset name';
            $this->$name = 'setting~~~';
        }
        return $this->$name;
    }
}

$stu = new Person();
$stu->name = 'Li';
$stu->age = 25;
$stu->sex = 'boy';

// 通过反射API获取这个stu对象的方法和属性的一个列表

// 获取对象的属性列表
$reflect = new ReflectionObject($stu);
$props = $reflect->getProperties();
foreach ($props as $key_p => $value_p) {
    var_dump($value_p->getName());
}

// 获取对象的方法列表
$method = $reflect->getMethods();
foreach ($method as $key_m => $value_m) {
    var_dump($value_m->getName());
}

// 反射API之外，我们还可以使用class函数来获取对象的各种属性以及方法的数据

// 获取对象的属性和关联数组
var_dump(get_object_vars($stu));
// 获取类属性
var_dump(get_class_vars(get_class($stu)));
// 获取类的方法名称组成的数组
var_dump(get_class_methods(get_class($stu)));

// class函数和反射API相比较起来，个人感觉还是后者更胜一筹啊
// 反射API甚至可以还原这个类的原型，包括方法的访问权限
$obj = new ReflectionObject($stu);
$class_name = $obj->getName();
$method_arr = $props_arr = [];

// 获取对象的属性列表
$props = $obj->getProperties();
foreach ($props as $key_p => $value_p) {
    $props_arr[$value_p->getName()] = $value_p;
}
// 获取对象的方法列表
$method = $obj->getMethods();
foreach ($method as $key_m => $value_m) {
    $method_arr[$value_m->getName()] = $value_m;
}

// 格式化输出类的属性以及方法
echo "class $class_name { " . PHP_EOL;
is_array($props_arr) && ksort($props_arr);
foreach ($props_arr as $key_o => $value_o) {
    echo "\t";
    echo $value_o->isPublic() ? 'public' : ' ', $value_o->isPrivate() ? 'private':' ', $value_o->isProtected() ? 'protected' : ' ', $value_o->isStatic() ? 'static' : ' ';
    echo "\t$value_o\n";
}

is_array($method_arr) && ksort($method_arr);
foreach ($method_arr as $key_e => $value_e) {
    echo "\t";
    echo $value_e->isPublic() ? 'public' : ' ' ,$value_e->isPrivate() ? 'private' : ' ' ,$value_e->isProtected() ? 'protected' : ' ';
    echo "\tfunction $value_e () {} \n";
}
echo '}';