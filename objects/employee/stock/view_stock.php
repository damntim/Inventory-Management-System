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

    // Fetch the stock data
    try {
        $sql = "SELECT * FROM stock WHERE ProductId = :product_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();
        $stock = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching stock data: " . $e->getMessage());
    }

    // Close connection
    $conn = null;
} else {
    echo "No product ID provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stock</title>
    <link rel="stylesheet" href="../../../styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>View Stock</h1>
    <?php if ($stock): ?>
        <p><strong>Product ID:</strong> <?php echo $stock['ProductId']; ?></p>
        <p><strong>Quantity:</strong> <?php echo $stock['Quantity']; ?></p>
        <p><strong>Last Updated:</strong> <?php echo $stock['LastUpdated']; ?></p>
        <p><strong>Category:</strong> <?php echo $stock['Category']; ?></p>
        <p><strong>Location:</strong> <?php echo $stock['Location']; ?></p>
    <?php else: ?>
        <p>No stock found with the given Product ID.</p>
    <?php endif; ?>
    <div class="button-group">
        <button onclick="window.location.href='../../../interfaces/employee/sm/index.php'">Back to Dashboard</button>
    </div>
</body>
</html>
