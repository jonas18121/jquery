<?php

class Database{

    public $sql_host;
    public $sql_login;
    public $sql_pwd;
    public $sql_db;
    public $bdd;

    public function __construct()
    {
        $this->sql_host     = "127.0.0.1";
        $this->sql_login    = "root";
        $this->sql_pwd      = "";
        $this->sql_db       = "fruits";
    } 

    public function connect_bdd()
    {
        return $this->bdd = new mysqli($this->sql_host, $this->sql_login, $this->sql_pwd, $this->sql_db);
    }
}

