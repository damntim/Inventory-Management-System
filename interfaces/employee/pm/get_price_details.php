<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once '../../../config/Database.php';
require_once '../../../objects/product/stockin/Stockin.php';

$response = ['status' => 'error', 'message' => 'Unknown error'];

if (isset($_GET['product_id']) && isset($_GET['supplier_id'])) {
    try {
        $database = new Database();
        $db = $database->getConnection();
        $stockin = new Stockin($db);

        $product_id = $_GET['product_id'];
        $supplier_id = $_GET['supplier_id'];

        $price_details = $stockin->fetchPriceDetails($product_id, $supplier_id);

        if ($price_details) {
            $response['status'] = 'success';
            $response['price_details'] = $price_details;
        } else {
            $response['message'] = 'No price details found.';
        }
    } catch (Exception $e) {
        $response['message'] = 'Error: ' . $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request. Missing product_id or supplier_id.';
}

echo json_encode($response);
?>
