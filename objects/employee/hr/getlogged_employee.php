<<<<<<< HEAD
<?php


require 'employee.php';
require '../../../config/Database.php'; 

$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);
$logged_in_employee_id = $_SESSION['employee_id']; // Get the logged-in employee's ID from session
$employees = $employee->listAllExceptLoggedIn($logged_in_employee_id);  // Retrieve employee data by ID
?>

=======
<?php


require 'employee.php';
require '../../../config/Database.php'; 

$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);
$logged_in_employee_id = $_SESSION['employee_id']; // Get the logged-in employee's ID from session
$employees = $employee->listAllExceptLoggedIn($logged_in_employee_id);  // Retrieve employee data by ID
?>

>>>>>>> 1246293a6213453a1a0595d6a058b70994d6c645
