
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Stock</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <h1>Add Stock</h1>
    <form action="handle_add_stock.php" method="POST">
        <label for="product_id">Product ID:</label>
        <input type="text" id="product_id" name="product_id" required><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br>

        <label for="last_updated">Last Updated:</label>
        <input type="date" id="last_updated" name="last_updated" required><br>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <button type="submit">Add Stock</button>
    </form>
</body>
</html>
