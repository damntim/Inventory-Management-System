<?php
require '../../../config/Database.php'; // Ensure this path is correct for including your Database.php file

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Create an instance of the Database class
    $database = new Database();
    $conn = $database->getConnection();

    // Check connection
    if ($conn === null) {
        die("Connection failed: Unable to establish a database connection");
    }

    // Delete stock from the database
    try {
        $sql = "DELETE FROM stock WHERE ProductId = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        // JavaScript for alert and redirection
        echo '<script>
            alert("Stock deleted successfully!");
            window.location.href = "../../../interfaces/employee/sm/index.php";
        </script>';
    } catch (PDOException $e) {
        die("Error deleting stock: " . $e->getMessage());
    }

    // Close connection
    $conn = null;
} else {
    echo "No product ID provided.";
}
?>
