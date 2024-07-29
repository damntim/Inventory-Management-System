<?php
require '../../../config/Database.php'; // Ensure this path is correct for including your Database.php file

// Create an instance of the Database class
$database = new Database();
$conn = $database->getConnection();

// Check connection
if ($conn === null) {
    die("Connection failed: Unable to establish a database connection");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $last_updated = date('Y-m-d H:i:s'); // Set the current date and time
    $category = $_POST['category'];
    $location = $_POST['location'];

    // Update stock in the database
    try {
        $sql = "UPDATE stock SET Quantity = :quantity, LastUpdated = :last_updated, Category = :category, Location = :location WHERE ProductId = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':last_updated', $last_updated);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':location', $location);
        $stmt->execute();

        // JavaScript for alert and redirection
        echo '<script>
            alert("Stock updated successfully!");
            window.location.href = "../../../interfaces/employee/sm/index.php";
        </script>';
    } catch (PDOException $e) {
        die("Error updating stock: " . $e->getMessage());
    }

    // Close connection
    $conn = null;
} else if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch the current stock data
    try {
        $sql = "SELECT * FROM stock WHERE ProductId = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $stock = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching stock data: " . $e->getMessage());
    }
} else {
    echo "No product ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Stock</title>
    <link rel="stylesheet" href="../../../styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Update Stock</h1>
    <form method="POST" action="update_stock.php">
        <input type="hidden" name="product_id" value="<?php echo $stock['ProductId']; ?>">
        
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $stock['Quantity']; ?>" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo $stock['Category']; ?>" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" value="<?php echo $stock['Location']; ?>" required><br>

        <input type="submit" value="Update Stock">
    </form>
    <div class="button-group">
        <button onclick="window.location.href='../../../interfaces/employee/sm/index.php'">Back to Dashboard</button>
    </div>
</body>
</html>
