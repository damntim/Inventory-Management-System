<?php
class Category {
    private $conn;
    private $table_name = "categories";

    public $id;
    public $categoryName;
    public $categoryDescription;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create category
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
            SET categoryName=:categoryName, categoryDescription=:categoryDescription";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->categoryName = htmlspecialchars(strip_tags($this->categoryName));
        $this->categoryDescription = htmlspecialchars(strip_tags($this->categoryDescription));

        // bind values
        $stmt->bindParam(":categoryName", $this->categoryName);
        $stmt->bindParam(":categoryDescription", $this->categoryDescription);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }


    // Update category
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
            SET categoryName=:categoryName, categoryDescription=:categoryDescription
            WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->categoryName = htmlspecialchars(strip_tags($this->categoryName));
        $this->categoryDescription = htmlspecialchars(strip_tags($this->categoryDescription));
        $this->id = htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindParam(":categoryName", $this->categoryName);
        $stmt->bindParam(":categoryDescription", $this->categoryDescription);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete category
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


    public function countCategories() {
        $query = "SELECT COUNT(id) AS total FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
    
    public function getCategories($start, $limit) {
        $query = "SELECT id, categoryName, categoryDescription, created_at FROM categories ORDER BY id ASC LIMIT :start, :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int) $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllCategories() {
        $query = "SELECT id, categoryName FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
