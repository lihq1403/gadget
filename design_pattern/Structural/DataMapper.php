<?php

/**
 * 数据映射器是一种数据访问层，它执行持久性数据存储（通常是关系数据库）和内存数据表示（域层）之间的数据双向传输。 该模式的目标是保持内存表示和持久数据存储相互独立，并保持数据映射器本身。 该层由一个或多个映射器（或数据访问对象）组成，执行数据传输。 映射器实现的范围有所不同。 通用映射器将处理许多不同的域实体类型，专用映射器将处理一个或几个。

这种模式的关键点在于，与活动记录模式不同，数据模型遵循单一责任原则。
 */

class User
{
    private string $username;

    private string $email;

    public function __construct(string $username, string $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public static function fromState(array $state): User
    {
        return new self($state['username'], $state['email']);
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

class StorageAdapter
{
    private array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function find(int $id)
    {
        return $this->data[$id] ?? null;
    }
}

class UserMapper
{
    private StorageAdapter $adapter;

    public function __construct(StorageAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    public function findById(int $id): ?User
    {
        $result = $this->adapter->find($id);
        if (! $result) {
            return null;
        }
        return $this->_mapRowToUser($result);
    }

    private function _mapRowToUser(array $row): User
    {
        return User::fromState($row);
    }
}

$storage1 = new StorageAdapter([1 => ['username' => 'li', 'email' => 'qq@qq.com']]);
$mapper = new UserMapper($storage1);
$user = $mapper->findById(1);
var_dump($user);

$storage2 = new StorageAdapter([]);
$mapper = new UserMapper($storage2);
$user = $mapper->findById(1);
var_dump($user);
