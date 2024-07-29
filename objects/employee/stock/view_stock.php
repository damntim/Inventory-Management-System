<?php
require '../../../config/Database.php'; // File where PDO instance is created

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $database = new Database();
    $pdo = $database->getConnection();

    $sql = "SELECT * FROM stock WHERE ProductId = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    $stock = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stock) {
        echo "<h1>Stock Details</h1>";
        echo "<p>Product ID: {$stock['ProductId']}</p>";
        echo "<p>Quantity: {$stock['Quantity']}</p>";
        echo "<p>Last Updated: {$stock['LastUpdated']}</p>";
        echo "<p>Category: {$stock['Category']}</p>";
        echo "<p>Location: {$stock['Location']}</p>";
    } else {
        echo "<p>Stock not found.</p>";
    }
} else {
    echo "<p>No stock ID provided.</p>";
}
?>
