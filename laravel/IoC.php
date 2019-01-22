<?php
/**
 * Created by PhpStorm.
 * User: lihq
 * Date: 2019/1/22
 * Time: 16:31
 */

// 定义写日志的接口规范
interface log
{
    public function write();
}

// 文件记录日志
class FileLog implements log
{
    public function write()
    {
        echo 'file log write...';
    }
}

// 数据库记录日志
class DatabaseLog implements log
{
    public function write()
    {
        echo 'database log write...';
    }
}

// 程序操作类
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
        echo 'login success...';
        $this->log->write();
    }
}

/**
 * 不需要自己内容修改，改成由外部外部传递。这种由外部负责其依赖需求的行为，我们可以称其为 “控制反转（IoC）”。
 */
$user = new User(new DatabaseLog());
$user->login();