<?php
class Stockin {
    private $conn;
    private $table_name = "stockin";

    public $stock_id;
    public $product_id;
    public $quantity;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new stockin record
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (product_id, quantity) 
                  VALUES ( :product_id, :quantity)";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);

        return $stmt->execute();
    }

    // Read all stockin records
    public function read() {
        $query = "SELECT stock_id, product_id, quantity FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Read a single stockin record by ID
    public function readOne() {
        $query = "SELECT stock_id, product_id, quantity FROM " . $this->table_name . " WHERE stock_id = :stock_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':stock_id', $this->stock_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->product_id = $row['product_id'];
            $this->quantity = $row['quantity'];
        }
    }

    // Update a stockin record
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET product_id = :product_id, quantity = :quantity 
                  WHERE stock_id = :stock_id";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':product_id', $this->product_id);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':stock_id', $this->stock_id);

        return $stmt->execute();
    }

    // Delete a stockin record
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE stock_id = :stock_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':stock_id', $this->stock_id);
        return $stmt->execute();
    }
}
?>
