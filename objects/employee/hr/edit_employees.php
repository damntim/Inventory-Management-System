<?php
session_start();
require '../../../config/Database.php'; 

include("employee.php"); // Assuming get_employee.php contains necessary includes and database connection
$database = new Database();
$pdo = $database->getConnection();
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the input data
    $id = htmlspecialchars($_POST['id']);
    $employee_id = htmlspecialchars($_POST['employee_id']);
    $full_name = htmlspecialchars($_POST['full_name']);
    $gmail = htmlspecialchars($_POST['gmail']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);
    $resident_gps = htmlspecialchars($_POST['resident_gps']);
    $position = htmlspecialchars($_POST['position']);
    $hired_date = htmlspecialchars($_POST['hired_date']);
    $contract_type = htmlspecialchars($_POST['contract_type']);
    $contract_length = htmlspecialchars($_POST['contract_length']);
    $bank_name = htmlspecialchars($_POST['bank_name']);
    $bank_account_number = htmlspecialchars($_POST['bank_account_number']);
    $status = htmlspecialchars($_POST['status']);
    $existing_image = htmlspecialchars($_POST['existing_image']);

    // Handle image upload
    if (!empty($_FILES['image']['name'])) {
        $target_dir = "../../../images/employees/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        // Validate file type and size if needed

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Delete the old image if a new one is uploaded successfully
            if ($existing_image && file_exists($target_dir . $existing_image)) {
                unlink($target_dir . $existing_image);
            }
            $image = basename($_FILES["image"]["name"]);
        } else {
            // Handle the error if the image was not uploaded
            $_SESSION['error'] = "Sorry, there was an error uploading your file.";
            header("Location: ../../../interfaces/employee/hr/all_employee.php");
            exit();
        }
    } else {
        $image = $existing_image;
    }

    // Update employee details in the database
    try {
        $employee_data = new Employee($pdo);
        $employee_data ->update($employee_id, $full_name, $gmail, $phone, $dob, $gender, $resident_gps, $image, $position, $hired_date, $contract_type, $contract_length, $bank_name, $bank_account_number, $status, $password, $id);

        $_SESSION['success'] = "Employee updated successfully.";
    } catch (Exception $e) {
        $_SESSION['error'] = "Error updating employee: " . $e->getMessage();
    }

    // Redirect to the employee list or another appropriate page
    header("Location: ../../../interfaces/employee/hr/all_employee.php");
    exit();
} else {
    $_SESSION['error'] = "Invalid request.";
    header("Location: ../../../interfaces/employee/hr/all_employee.php");
    exit();
}
?>
