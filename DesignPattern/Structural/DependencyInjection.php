<?php

/**
 * 用松散耦合的方式来更好的实现可测试、可维护和可扩展的代码。

依赖注入模式：依赖注入（Dependency Injection）是控制反转（Inversion of Control）的一种实现方式。要实现控制反转，通常的解决方案是将创建被调用者实例的工作交由 IoC 容器来完成，然后在调用者中注入被调用者（通过构造器 / 方法注入实现），这样我们就实现了调用者与被调用者的解耦，该过程被称为依赖注入。
 */

class DatabaseConfiguration
{
    private string $host;

    private int $port;

    private string $username;

    private string $password;

    public function __construct(string $host, int $port, string $username, string $password)
    {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

class DatabaseConnection
{
    private DatabaseConfiguration $configuration;

    public function __construct(DatabaseConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getDsn(): string
    {
        return sprintf(
            '%s:%s@%s:%d',
            $this->configuration->getUsername(),
            $this->configuration->getPassword(),
            $this->configuration->getHost(),
            $this->configuration->getPort()
        );
    }
}

$config = new DatabaseConfiguration('localhost', 3306, 'xi', '1234');
$connection = new DatabaseConnection($config);
var_dump($connection->getDsn());