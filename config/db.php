<?php

class Db
{
    private $host = "localhost";
    private $db_name = "sofftdb";
    private $username = "root";
    private $password = "";

    public $conn = null;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $exception) {
            $this->getConnection();
            return $this->conn;
        }
        return $this->conn;
    }

    public function closeConnection()
    {
        $this->conn = null;
    }
}
