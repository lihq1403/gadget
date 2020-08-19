<?php

interface Log
{
    public function write();
}

class FileLog implements Log
{
    public function write()
    {
        echo 'file log write...'.PHP_EOL;
    }
}

class DatabaseLog implements Log
{
    public function write()
    {
        echo 'file log write...'.PHP_EOL;
    }
}

class User
{
    protected $log;

    public function __construct(Log $log)
    {
        $this->log = $log;
    }

    public function login()
    {
        // 登录成功，记录登录日志
        echo 'login success...'.PHP_EOL;
        $this->log->write();
    }
}

class Ioc
{
    public $binding = [];

    public function bind($abstract, $concrete)
    {
        if (!$concrete instanceof Closure) {
            $concrete = function ($ioc) use ($concrete) {
                return $ioc->build($concrete);
            };
        }
        // bind的时候还不需要创建User对象，所以采用closure等make的时候再创建FileLog
        $this->binding[$abstract]['concrete'] = $concrete;
    }

    public function make($abstract)
    {
        $concrete = $this->binding[$abstract]['concrete'];
        return $concrete($this);
    }

    // 创建对象
    public function build($concrete)
    {
        $reflector = new ReflectionClass($concrete);
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return $reflector->newInstance();
        } else {
            $dependencies = $constructor->getParameters();
            $instances = $this->getDependencies($dependencies);
            return $reflector->newInstanceArgs($instances);
        }
    }

    // 获取参数的依赖
    protected function getDependencies($parameters)
    {
        $dependencies = [];
        foreach ($parameters as $parameter) {
            $dependencies[] = $this->make($parameter->getClass()->name);
        }
        return $dependencies;
    }
}

/**
 * Class UserFacade
 *
 * @method static login()
 */
class UserFacade
{
    /**
     * @var Ioc
     */
    protected static $ioc;

    public static function setFacadeIoc($ioc)
    {
        static::$ioc = $ioc;
    }

    protected static function getFacadeAccessor()
    {
        return 'User';
    }

    public static function __callStatic($method, $arguments)
    {
        $instance = static::$ioc->make(static::getFacadeAccessor());
        return $instance->$method(...$arguments);
    }
}

//实例化IoC容器
$ioc = new Ioc();
$ioc->bind('Log', 'FileLog');
$ioc->bind('User', 'User');

UserFacade::setFacadeIoc($ioc);
UserFacade::login();
