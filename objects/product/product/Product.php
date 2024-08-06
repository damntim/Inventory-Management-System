<?php
class Product {
    private $conn;
<<<<<<< HEAD
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
=======
    private $table_name = "products_tab";

    public $product_id;
    public $product_name;
    public $description;
    public $warehouse_id;
    public $category_id;
    public $product_image;
>>>>>>> 1246293a6213453a1a0595d6a058b70994d6c645

    public function __construct($db) {
        $this->conn = $db;
    }

<<<<<<< HEAD
    // Create product
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
            SET productName=:productName, productImage=:productImage, supplyPrice=:supplyPrice, 
            sellingPrice=:sellingPrice, productCategory=:productCategory, quantity=:quantity, 
            stock=:stock, productDescription=:productDescription";
=======
    public function addProduct() {
        $query = "INSERT INTO " . $this->table_name . " SET
            product_name = :product_name,
            description = :description,
            warehouse_id = :warehouse_id,
            category_id = :category_id,
            product_image = :product_image";
>>>>>>> 1246293a6213453a1a0595d6a058b70994d6c645

        $stmt = $this->conn->prepare($query);

        // sanitize
<<<<<<< HEAD
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
=======
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
>>>>>>> 1246293a6213453a1a0595d6a058b70994d6c645

        if ($stmt->execute()) {
            return true;
        }
<<<<<<< HEAD

        return false;
    }

    // Read products
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
=======
        return false;
    }
    public function getProduct() {
        $query = "
            SELECT p.* 
            FROM " . $this->table_name . " p
        ";
    
>>>>>>> 1246293a6213453a1a0595d6a058b70994d6c645
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
<<<<<<< HEAD

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
=======
      

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
>>>>>>> 1246293a6213453a1a0595d6a058b70994d6c645
    }
}
?>
