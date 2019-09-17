- __construct()
- __destruct()
- __call()
- __callStatic()
- __get()
-  __set()
-  __isset()
-  __unset()
-  __sleep()
-  __wakeup()
-  __toString()
-  __invoke()
-  __set_state()
-  __clone()
- __debugInfo() 
 
 等方法在 PHP 中被称为魔术方法（Magic methods）。在命名自己的类方法时不能使用这些方法名，除非是想使用其魔术功能。

Caution
PHP 将所有以 __（两个下划线）开头的类方法保留为魔术方法。所以在定义类方法时，除了上述魔术方法，建议不要以 __ 为前缀。