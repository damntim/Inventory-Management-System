<?php
include_once 'config.php';

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        // Delete the product
        $sql = "DELETE FROM products WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        header('Location: view_products.php');
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Product ID is not specified.";
}
?>
