<?php

class DBManager
{
    private $conn;

    public function __construct()
    {
        $host = "db";
        $dbname = "admission";
        $username = "root";
        $password = "Thebest1";

        try {
            $this->conn = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password
            );
            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            $this->conn->setAttribute(
                PDO::ATTR_DEFAULT_FETCH_MODE,
                PDO::FETCH_ASSOC
            );

        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}