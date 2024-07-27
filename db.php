<?php
// Database connection parameters
$host = 'localhost'; // or your host
$dbname = 'inventory'; // replace with your database name
$username = 'root'; // replace with your database username
$password = ''; // replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Handle connection error
    die("Database connection failed: " . $e->getMessage());
}
?>
