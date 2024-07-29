<?php
require '../../../config/Database.php'; // Adjust this path according to your directory structure

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $last_updated = date('Y-m-d H:i:s'); // Set the current date and time
    $category = $_POST['category'];
    $location = $_POST['location'];

    // Create an instance of the Database class
    $database = new Database();
    $conn = $database->getConnection();

    // Check connection
    if ($conn === null) {
        die("Connection failed: Unable to establish a database connection");
    }

    // Insert stock into database
    try {
        $sql = "INSERT INTO stock (ProductId, Quantity, LastUpdated, Category, Location) VALUES (:product_id, :quantity, :last_updated, :category, :location)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':last_updated', $last_updated);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':location', $location);
        $stmt->execute();

        // JavaScript for alert and redirection
        echo '<script>
            alert("Stock added successfully!");
            window.location.href = "../../../interfaces/employee/sm/index.php";
        </script>';
    } catch (PDOException $e) {
        die("Error adding stock: " . $e->getMessage());
    }

    // Close connection
    $conn = null;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <link rel="stylesheet" href="../../../styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Add Stock</h1>
    <form method="POST" action="add_stock.php">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <input type="submit" value="Add Stock">
    </form>
    <div class="button-group">
        <button onclick="window.location.href='../../../interfaces/employee/sm/index.php'">Back to Dashboard</button>
    </div>
</body>
</html>
