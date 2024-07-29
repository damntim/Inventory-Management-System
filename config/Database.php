<?php
class Database {
    private $host = "127.0.0.1";
    private $db_name = "inventory";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
            $this->createTableIfNotExists();
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
    private function createTableIfNotExists() {
        $query = "
        CREATE TABLE IF NOT EXISTS prices (
            id INT AUTO_INCREMENT PRIMARY KEY,
            productID INT NOT NULL,
            amount DECIMAL(10, 2) NOT NULL,
            pricestype VARCHAR(50) NOT NULL,
            partnerID INT NOT NULL,
            netprice DECIMAL(10, 2) NOT NULL
        )";
        
        try {
            $this->conn->exec($query);
           
        } catch (PDOException $exception) {
            echo "Error creating table: " . $exception->getMessage() . "<br>";
        }
    }
}

?>
