<?php
include_once '../../../config/database.php';
include_once 'warehouse.php';

// Instantiate the database and warehouse objects
$database = new Database();
$db = $database->getConnection();
$warehouse = new warehouse($db);

// Retrieve all warehouses
$warehouses = $warehouse->read();

?>