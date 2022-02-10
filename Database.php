<?php

require_once 'config.php';

class Database
{
    public function __construct(
        private string $username = USERNAME,
        private string $password = PASSWORD,
        private string $host = HOST,
        private string $database = DATABASE
    ) {}

    public function connect() {
        try {
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"]
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            return $conn;
        }
        catch (PDOException $e) {
            die("Connection failed: ".$e->getMessage());
        }
    }
}
