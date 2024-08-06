<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../../config/Database.php';
require_once '../../../objects/partner/supplier/Supplier.php';
require_once '../../../objects/employee/price/Price.php';

$response = ['status' => 'error', 'message' => 'Unknown error'];

if (isset($_GET['product_id'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();

        $product_id = $_GET['product_id'];

        // Fetch supplier with prices for the selected product
        $query = "SELECT supplier.id, supplier.fullname 
                  FROM supplier 
                  JOIN prices ON supplier.id = prices.supplier_id 
                  WHERE prices.product_id = :product_id";
        
        $stmt = $db->prepare($query);
        $stmt->bindParam(':product_id', $product_id);
        $stmt->execute();

        $suppliers = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $suppliers[] = $row;
        }

        $response['status'] = 'success';
        $response['supplier'] = $suppliers;

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Product ID not provided';
}

echo json_encode($response);
?>
