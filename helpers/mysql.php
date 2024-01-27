<?php


class DataBase
{

    private $servername = "localhost";
    private $username = "Nick";
    private $password = "(jtc-t1@]g41Kq77";
    private $dbname = "project_database";
    public static $conn;

    function __construct()
    {
        // Create connection
        self::$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection

        if (self::$conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        self::$conn->set_charset("utf8");
    }
}
