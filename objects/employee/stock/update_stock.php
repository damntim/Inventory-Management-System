<?php
require '../../../config/Database.php'; // File where PDO instance is created

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    $database = new Database();
    $pdo = $database->getConnection();

    // Fetch existing stock details
    $sql = "SELECT * FROM stock WHERE ProductId = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    $stock = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($stock) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $quantity = $_POST['quantity'];
            $last_updated = $_POST['last_updated'];
            $category = $_POST['category'];
            $location = $_POST['location'];

            $update_sql = "UPDATE stock SET Quantity = :quantity, LastUpdated = :last_updated, Category = :category, Location = :location WHERE ProductId = :product_id";
            $update_stmt = $pdo->prepare($update_sql);
            $update_stmt->bindParam(':quantity', $quantity);
            $update_stmt->bindParam(':last_updated', $last_updated);
            $update_stmt->bindParam(':category', $category);
            $update_stmt->bindParam(':location', $location);
            $update_stmt->bindParam(':product_id', $product_id);
            $update_stmt->execute();

            echo '<script>
                alert("Stock updated successfully!");
                window.location.href = "list_of_all_stock.php";
            </script>';
        }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Stock</title>
            <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
        </head>
        <body>
            <h1>Update Stock</h1>
            <form action="update_stock.php?id=<?php echo $product_id; ?>" method="POST">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" value="<?php echo $stock['Quantity']; ?>" required><br>

                <label for="last_updated">Last Updated:</label>
                <input type="date" id="last_updated" name="last_updated" value="<?php echo $stock['LastUpdated']; ?>" required><br>

                <label for="category">Category:</label>
                <input type="text" id="category" name="category" value="<?php echo $stock['Category']; ?>" required><br>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" value="<?php echo $stock['Location']; ?>" required><br>

                <button type="submit">Update Stock</button>
            </form>
        </body>
        </html>
        <?php
    } else {
        echo "<p>Stock not found.</p>";
    }
} else {
    echo "<p>No stock ID provided.</p>";
}
?>
