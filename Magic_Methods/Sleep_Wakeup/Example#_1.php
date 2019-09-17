<?php

class Connection
{
    protected $link;
    private $server, $username, $password, $db;

    public function __construct($server, $username, $password, $db)
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->db = $db;
        $this->connect();
    }

    private function connect()
    {
        $this->link = mysqli_connect($this->server, $this->username, $this->password);
        mysqli_select_db($this->db, $this->link);
    }

    public function __sleep()
    {
        return ['server', 'username', 'password', 'db'];
    }

    public function __wakeup()
    {
        $this->connect();
    }
}