<?php
include_once '../../../config/Database.php';
include_once 'Stock.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Prepare stock object
$stock = new Stock($db);

// Set stock property values
$stock->category = $_POST['StockCategory'];
$stock->location = $_POST['StockLocation'];
$stock->description = $_POST['StockDescription'];
$stock->created_at = date('Y-m-d H:i:s');
$stock->updated_at = date('Y-m-d H:i:s');

// Create the stock
if($stock->create()){
    echo '<script>
    alert("Categories added successfully!");
    window.location.href = "../../../interfaces/employee/sm/all_stocks.php";
</script>';
} else{
    echo '<script>
    alert("Categories add failed!");
    window.location.href = "../../../interfaces/employee/pm/addStock.php";
</script>';
}
?>
