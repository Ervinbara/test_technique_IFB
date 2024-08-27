<?php
// Database.php

class Database {
    private $host = 'localhost';
    private $dbName = 'todo_list';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName}";
        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
