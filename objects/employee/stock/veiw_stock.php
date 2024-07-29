<?php
include_once '../../../config/database.php';
include_once 'Stock.php';

// Instantiate the database and stock objects
$database = new Database();
$db = $database->getConnection();
$stock = new Stock($db);

// Retrieve all stocks
$stocks = $stock->read();

?>