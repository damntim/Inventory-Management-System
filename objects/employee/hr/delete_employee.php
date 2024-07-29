<?php

session_start();
require '../../../config/Database.php'; 
include("employee.php");
$database = new Database();
$pdo = $database->getConnection();

// Check if employee_id is provided
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "No employee ID specified.";
    exit();
}
if (isset($_GET['id'])) {
    $employee_id = intval($_GET['id']);
} else {
    echo "Employee ID is missing.";
    exit();
}


// Get the employee ID from the GET request
$employee_id = $_GET['id'];

// Validate the employee ID to ensure it's an integer
if (!filter_var($employee_id, FILTER_VALIDATE_INT)) {
    echo "Invalid employee ID.";
    exit();
}

try {
    // Prepare the SQL statement to delete the employee
    $stmt = $pdo->prepare("DELETE FROM employees WHERE employee_id = :employee_id");
    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);

    // Execute the statement
    $stmt->execute();

    // Check if any rows were affected
    if ($stmt->rowCount() > 0) {
        echo '<script>
        alert("Employee Deleted successfully!");
        window.location.href = " window.location.href = "../../../interfaces/employee/hr/all_employee.php";
    </script>';
        exit();
    } else {
        // No rows affected, which means no employee with that ID
        echo "No employee found with the specified ID.";
    }
} catch (PDOException $e) {
    // Catch any PDO exception and display an error message
    echo "Error: " . $e->getMessage();
}
?>
