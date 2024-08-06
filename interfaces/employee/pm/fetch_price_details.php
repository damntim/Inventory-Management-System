<?php
require_once '../../../config/Database.php';
require_once '../../../objects/product/stockin/Stockin.php';

$database = new Database();
$db = $database->getConnection();
$stockin = new Stockin($db);

$product_id = $_POST['product_id'];
$supplier_id = $_POST['supplier_id'];

$price_details = $stockin->fetchPriceDetails($product_id, $supplier_id);

if ($price_details) {
    echo json_encode(['success' => true, 'amount' => $price_details['amount'], 'netprice' => $price_details['netprice'], 'taxrate' => $price_details['taxrate'], 'discount' => $price_details['discount']]);
} else {
    echo json_encode(['success' => false]);
}
?>
