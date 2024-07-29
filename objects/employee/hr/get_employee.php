<?php
require 'employee.php';
require '../../../config/Database.php'; 

$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);
$employee_id = $_GET['id']; // Get the employee ID from the URL parameter
$employee_data = $employee->read($employee_id);
$logged_in_employee_id = $_SESSION['employee_id']; // Get the logged-in employee's ID from session
$employees = $employee->listAllExceptLoggedIn($logged_in_employee_id);  // Retrieve employee data by ID
?>
