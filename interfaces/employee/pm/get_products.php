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
        $query = "SELECT products_tab.product_id, products_tab.product_name 
                  FROM products_tab 
                  JOIN prices ON products_tab.product_id = prices.productID 
                  WHERE prices.paternerID = :supplier_id";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':supplier_id', $supplier_id);
        $stmt->execute();

        $products = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $products[] = $row;
        }

        $response['status'] = 'success';
        $response['products'] = $products;

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Supplier ID not provided';
}

echo json_encode($response);
?>
