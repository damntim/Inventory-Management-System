<?php
class Supplier {
    private $conn;
    private $table_name = "supplier";

    public $id;
    public $tin;
    public $fullname;
    public $email;
    public $address;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create a new supplier
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET tin = :tin, fullname = :fullname, email = :email, address = :address";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':tin', $this->tin);
        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':address', $this->address);

        return $stmt->execute();
    }

    public function getSuppliers($product_id) {
        $query = "
            SELECT s.id, s.tin, s.fullname, s.email, s.address 
            FROM " . $this->table_name . " s
            JOIN prices p ON s.id = p.paternerID
            WHERE p.productID = :product_id
            AND p.pricetype = 'purchase'
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
    
        return $stmt;
    }
    public function getSupplier() {
        $query = "
            SELECT supplier.id, supplier.tin, supplier.fullname, supplier.email, supplier.address 
            FROM " . $this->table_name ;
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }

    // Read a single supplier by ID
    public function readOne() {
        $query = "SELECT id, tin, fullname, email, address FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $this->tin = $row['tin'];
            $this->fullname = $row['fullname'];
            $this->email = $row['email'];
            $this->address = $row['address'];
        }
    }

    // Update supplier information
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET tin = :tin, fullname = :fullname, email = :email, address = :address
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Bind parameters
        $stmt->bindParam(':tin', $this->tin);
        $stmt->bindParam(':fullname', $this->fullname);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Delete a supplier
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>
