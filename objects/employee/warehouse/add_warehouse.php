<?php
include_once '../../../config/Database.php';
include_once 'warehouse.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Prepare warehouse object
$warehouse = new warehouse($db);

// Set warehouse property values
$warehouse->category = $_POST['warehouseCategory'];
$warehouse->location = $_POST['warehouseLocation'];
$warehouse->description = $_POST['warehouseDescription'];
$warehouse->created_at = date('Y-m-d H:i:s');
$warehouse->updated_at = date('Y-m-d H:i:s');

// Create the warehouse
if($warehouse->create()){
    echo '<script>
    alert("Warehouse added successfully!");
    window.location.href = "../../../interfaces/employee/pm/all_warehouse.php";
</script>';
} else{
    echo '<script>
    alert("Warehouse add failed!");
    window.location.href = "../../../interfaces/employee/pm/addwarehouse.php";
</script>';
}
?>
