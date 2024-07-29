
<?php
require 'Stock.php'; // Assuming you have a Stock class for handling stock-related operations
require '../../../db.php'; // File where PDO instance is created

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $last_updated = $_POST['last_updated'];
    $category = $_POST['category'];
    $location = $_POST['location'];

    // Create an instance of Stock class
    $stock = new Stock($pdo);

    // Add stock to database
    try {
        $stock->create($product_id, $quantity, $last_updated, $category, $location);
        echo '<script>
            alert("Stock added successfully!");
            window.location.href = "list_of_all_stock.php";
        </script>';
    } catch (Exception $e) {
        echo '<script>
            alert("Error adding stock: ' . $e->getMessage() . '");
        </script>';
    }
}
?>
