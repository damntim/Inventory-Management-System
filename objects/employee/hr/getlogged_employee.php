<?php


require 'employee.php';
require '../../../config/Database.php'; 

$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);
$logged_in_employee_id = $_SESSION['employee_id']; // Get the logged-in employee's ID from session
$employees = $employee->listAllExceptLoggedIn($logged_in_employee_id);  // Retrieve employee data by ID
?>

