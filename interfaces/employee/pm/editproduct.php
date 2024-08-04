<?php
include_once 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Fetch the product details
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission to update the product
            $productName = $_POST['productName'];
            $supplyPrice = $_POST['supplyPrice'];
            $sellingPrice = $_POST['sellingPrice'];
            $productCategory = $_POST['productCategory'];
            $quantity = $_POST['quantity'];
            $stock = $_POST['stock'];
            $productDescription = $_POST['productDescription'];

            $update_sql = "UPDATE products SET 
                productName = :productName,
                supplyPrice = :supplyPrice,
                sellingPrice = :sellingPrice,
                productCategory = :productCategory,
                quantity = :quantity,
                stock = :stock,
                productDescription = :productDescription
                WHERE id = :id";

            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->execute([
                ':productName' => $productName,
                ':supplyPrice' => $supplyPrice,
                ':sellingPrice' => $sellingPrice,
                ':productCategory' => $productCategory,
                ':quantity' => $quantity,
                ':stock' => $stock,
                ':productDescription' => $productDescription,
                ':id' => $id
            ]);

            header('Location: view_products.php');
            exit();
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Product ID is not specified.";
}
?>

<!-- HTML form for editing the product -->
<form method="post">
    <!-- Form fields for editing the product -->
    <input type="text" name="productName" value="<?php echo htmlspecialchars($product['productName']); ?>" required>
    <input type="number" name="supplyPrice" value="<?php echo htmlspecialchars($product['supplyPrice']); ?>" required>
    <input type="number" name="sellingPrice" value="<?php echo htmlspecialchars($product['sellingPrice']); ?>" required>
    <!-- Additional fields... -->
    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
