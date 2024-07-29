<?php
class Product {
    private $conn;
    private $table_name = "products";

    public $id;
    public $productName;
    public $productImage;
    public $supplyPrice;
    public $sellingPrice;
    public $productCategory;
    public $quantity;
    public $stock;
    public $productDescription;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create product
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
            SET productName=:productName, productImage=:productImage, supplyPrice=:supplyPrice, 
            sellingPrice=:sellingPrice, productCategory=:productCategory, quantity=:quantity, 
            stock=:stock, productDescription=:productDescription";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productName = htmlspecialchars(strip_tags($this->productName));
        $this->productImage = htmlspecialchars(strip_tags($this->productImage));
        $this->supplyPrice = htmlspecialchars(strip_tags($this->supplyPrice));
        $this->sellingPrice = htmlspecialchars(strip_tags($this->sellingPrice));
        $this->productCategory = htmlspecialchars(strip_tags($this->productCategory));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->productDescription = htmlspecialchars(strip_tags($this->productDescription));

        // bind values
        $stmt->bindParam(":productName", $this->productName);
        $stmt->bindParam(":productImage", $this->productImage);
        $stmt->bindParam(":supplyPrice", $this->supplyPrice);
        $stmt->bindParam(":sellingPrice", $this->sellingPrice);
        $stmt->bindParam(":productCategory", $this->productCategory);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":productDescription", $this->productDescription);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read products
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update product
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
            SET productName=:productName, productImage=:productImage, supplyPrice=:supplyPrice, 
            sellingPrice=:sellingPrice, productCategory=:productCategory, quantity=:quantity, 
            stock=:stock, productDescription=:productDescription
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->productName = htmlspecialchars(strip_tags($this->productName));
        $this->productImage = htmlspecialchars(strip_tags($this->productImage));
        $this->supplyPrice = htmlspecialchars(strip_tags($this->supplyPrice));
        $this->sellingPrice = htmlspecialchars(strip_tags($this->sellingPrice));
        $this->productCategory = htmlspecialchars(strip_tags($this->productCategory));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->stock = htmlspecialchars(strip_tags($this->stock));
        $this->productDescription = htmlspecialchars(strip_tags($this->productDescription));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindParam(":productName", $this->productName);
        $stmt->bindParam(":productImage", $this->productImage);
        $stmt->bindParam(":supplyPrice", $this->supplyPrice);
        $stmt->bindParam(":sellingPrice", $this->sellingPrice);
        $stmt->bindParam(":productCategory", $this->productCategory);
        $stmt->bindParam(":quantity", $this->quantity);
        $stmt->bindParam(":stock", $this->stock);
        $stmt->bindParam(":productDescription", $this->productDescription);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete product
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
