<?php


include("employee.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $employee_id = $_POST['employee_id'];
    $full_name = $_POST['full_name'];
    $gmail = $_POST['gmail'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $resident_gps = $_POST['resident_gps'];
    $position = $_POST['position'];
    $hired_date = $_POST['hired_date'];
    $contract_type = $_POST['contract_type'];
    $contract_length = $_POST['contract_length'];
    $bank_name = $_POST['bank_name'];
    $bank_account_number = $_POST['bank_account_number'];
    $status = $_POST['status'];
    $password = $_POST['password'];

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image']['name'];
        $uploadDir = '../../../images/employees/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
    } else {
        $image = ''; // or handle error
    }

    // Create an instance of Employee class
   

    // Add employee to database
    $employee->create($employee_id, $full_name, $gmail, $phone, $dob, $gender, $resident_gps, $image, $position, $hired_date, $contract_type, $contract_length, $bank_name, $bank_account_number, $status, $password);

    // JavaScript for alert and redirection
    echo '<script>
        alert("Employee added successfully!");
        window.location.href = "../../../interfaces/employee/hr/all_employee.php";
    </script>';
}
?>
