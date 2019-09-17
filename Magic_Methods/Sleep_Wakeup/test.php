<?php

class User
{
    public $name;
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function __sleep()
    {
        return ['name'];
    }

    public function __wakeup()
    {
        $this->id = 456;
    }


}

$user = new User(123);
$user->name = "L";
$s = serialize($user); // serialize串行化对象u，此处不串行化id属性，id值被抛弃
$user2 = unserialize($s); // unserialize反串行化，id值被重新赋值

print_r($user);
print_r($user2);
print_r($s);