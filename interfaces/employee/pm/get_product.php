<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../../config/Database.php';
require_once '../../../objects/product/product/Product.php';

$response = ['status' => 'error', 'message' => 'Unknown error'];

if (isset($_GET['supplier_id'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();

        $supplier_id = $_GET['supplier_id'];

        // Fetch products for the selected supplier
        $query = "SELECT p.product_id, p.product_name 
                  FROM products_tab p
                  JOIN prices pr ON p.product_id = pr.ProductID
                  WHERE pr.paternerID = ? AND pr.pricetype = 'purchase'";

        $stmt = $db->prepare($query);
        if ($stmt->execute([$supplier_id])) {
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'products' => $products];
        } else {
            $response['message'] = 'Failed to execute query.';
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Supplier ID not provided.';
}

echo json_encode($response);
?>
