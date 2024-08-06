<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../../config/Database.php';
require_once '../../../objects/partner/supplier/Supplier.php';
require_once '../../../objects/employee/price/Price.php';

$response = ['status' => 'error', 'message' => 'Unknown error'];

if (isset($_GET['supplier_id'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();

        $supplier_id = $_GET['supplier_id'];

        // Fetch product with prices for the selected supplier
        $query = "SELECT product.fullname,product.id  
                  FROM supplier 
                  JOIN prices ON supplier.id = prices.paternerID 
                  WHERE prices.supplierID = ? AND prices.pricetype = 'purchase'";

        $stmt = $db->prepare($query);
        if ($stmt->execute([$supplier_id])) {
            $supplier = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $response = ['status' => 'success', 'supplier' => $supplier];
        } else {
            $response['message'] = 'Failed to execute query.';
        }
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'supplier ID not provided.';
}

echo json_encode($response);
?>
