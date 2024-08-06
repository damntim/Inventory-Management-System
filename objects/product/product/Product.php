<?php
class Product {
    private $conn;
    private $table_name = "products_tab";

    public $product_id;
    public $product_name;
    public $description;
    public $warehouse_id;
    public $category_id;
    public $product_image;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addProduct() {
        $query = "INSERT INTO " . $this->table_name . " SET
            product_name = :product_name,
            description = :description,
            warehouse_id = :warehouse_id,
            category_id = :category_id,
            product_image = :product_image";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->product_name = htmlspecialchars(strip_tags($this->product_name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->warehouse_id = htmlspecialchars(strip_tags($this->warehouse_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->product_image = htmlspecialchars(strip_tags($this->product_image));

        // bind values
        $stmt->bindParam(":product_name", $this->product_name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":warehouse_id", $this->warehouse_id);
        $stmt->bindParam(":category_id", $this->category_id);
        $stmt->bindParam(":product_image", $this->product_image);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    public function getProduct() {
        $query = "
            SELECT p.* 
            FROM " . $this->table_name . " p
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
      

    public function getProducts() {
        $query = "
            SELECT p.* 
            FROM " . $this->table_name . " p
            JOIN prices pr ON p.product_id = pr.productID
            WHERE pr.pricetype = 'purchase'
        ";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    

    // Read products with quantity > 0 in stockin table and pricetype = 'selling' in prices table
    public function readAvailableProducts() {
        $query = "
            SELECT p.product_id, p.product_name, p.description, p.product_image, pr.netprice AS selling_price
            FROM " . $this->table_name . " p
            JOIN stockin s ON p.product_id = s.product_id
            JOIN prices pr ON p.product_id = pr.productID
            WHERE s.quantity > 0 AND pr.pricetype = 'selling'
            GROUP BY p.product_id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
