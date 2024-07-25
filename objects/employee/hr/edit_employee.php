<?php
require '../../../db.php'; // Ensure this file contains the PDO instance
session_start();

if (!isset($_SESSION['employee_id'])) {
    echo "Employee ID is not set in session.";
    exit();
}

// Retrieve employee ID from URL parameter
if (isset($_GET['id'])) {
    $employee_id = intval($_GET['id']);
} else {
    echo "Employee ID is missing.";
    exit();
}

// Fetch the employee data from the database
$stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id = :employee_id");
$stmt->execute(['employee_id' => $employee_id]);
$employee = $stmt->fetch();

if (!$employee) {
    echo "Employee not found.";
    exit();
}

// Handle form submission for updating employee details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize inputs
    $full_name = htmlspecialchars($_POST['full_name']);
    $gmail = htmlspecialchars($_POST['gmail']);
    $phone = htmlspecialchars($_POST['phone']);
    $dob = htmlspecialchars($_POST['dob']);
    $gender = htmlspecialchars($_POST['gender']);
    $resident_gps = htmlspecialchars($_POST['resident_gps']);
    $position = htmlspecialchars($_POST['position']);
    $hired_date = htmlspecialchars($_POST['hired_date']);
    $contract_type = htmlspecialchars($_POST['contract_type']);
    $contract_length = intval($_POST['contract_length']);
    $bank_name = htmlspecialchars($_POST['bank_name']);
    $bank_account_number = htmlspecialchars($_POST['bank_account_number']);
    $status = htmlspecialchars($_POST['status']);
    $password = htmlspecialchars($_POST['password']);
    
    // Handle image upload
    $imagePath = $employee['image']; // Default to current image
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        $fileType = $_FILES['image']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Allowed file extensions
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileExtension, $allowedExts)) {
            // Create a unique name for the file
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = 'uploads/';
            $dest_path = $uploadFileDir . $newFileName;

            // Move the file to the uploads directory
            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update the image path
                $imagePath = $newFileName;
            } else {
                echo "There was an error uploading the file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }

    // Hash the password if provided
    $hashed_password = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : $employee['password'];

    // Update the employee record
    $stmt = $pdo->prepare("UPDATE employees SET full_name = :full_name, gmail = :gmail, phone = :phone, dob = :dob, gender = :gender, resident_gps = :resident_gps, position = :position, hired_date = :hired_date, contract_type = :contract_type, contract_length = :contract_length, bank_name = :bank_name, bank_account_number = :bank_account_number, status = :status, password = :password, image = :image WHERE employee_id = :employee_id");
    $stmt->execute([
        'full_name' => $full_name,
        'gmail' => $gmail,
        'phone' => $phone,
        'dob' => $dob,
        'gender' => $gender,
        'resident_gps' => $resident_gps,
        'position' => $position,
        'hired_date' => $hired_date,
        'contract_type' => $contract_type,
        'contract_length' => $contract_length,
        'bank_name' => $bank_name,
        'bank_account_number' => $bank_account_number,
        'status' => $status,
        'password' => $hashed_password,
        'image' => $imagePath,
        'employee_id' => $employee_id
    ]);

    echo '<script>
    alert("Employee Updated successfully!");
    window.location.href = "list_of_all_employees.php";
</script>';
}

// Fetch the current profile image path
$profileImagePath = !empty($employee['image']) ? '../../../images/employees/' . htmlspecialchars($employee['image']) : 'default_profile.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-section {
            margin-bottom: 20px;
        }
        .form-wrapper {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        .form-section h3 {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-center {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-5">Edit Employee Details</h2>
        <form action="" method="post" class="form-wrapper" enctype="multipart/form-data">
            <div class="form-section row">
                <h3 class="col-12">Personal Information</h3>
                <div class="form-group col-md-6">
                    <label for="employee_id">Employee ID</label>
                    <input type="text" id="employee_id" name="employee_id" class="form-control" value="<?php echo htmlspecialchars($employee['employee_id']); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo htmlspecialchars($employee['full_name']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="gmail">Gmail</label>
                    <input type="email" id="gmail" name="gmail" class="form-control" value="<?php echo htmlspecialchars($employee['gmail']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($employee['phone']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="dob">Date of Birth</label>
                    <input type="date" id="dob" name="dob" class="form-control" value="<?php echo htmlspecialchars($employee['dob']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="gender">Gender</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="male" <?php echo $employee['gender'] == 'male' ? 'selected' : ''; ?>>Male</option>
                        <option value="female" <?php echo $employee['gender'] == 'female' ? 'selected' : ''; ?>>Female</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="resident_gps">Resident GPS</label>
                    <input type="text" id="resident_gps" name="resident_gps" class="form-control" value="<?php echo htmlspecialchars($employee['resident_gps']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="image">Profile Image</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <small class="form-text text-muted">Current Image: <img src="<?php echo $profileImagePath; ?>" alt="Profile Image" style="max-width: 100px;"></small>
                </div>
            </div>
            <div class="form-section row">
                <h3 class="col-12">Job Information</h3>
                <div class="form-group col-md-6">
                    <label for="position">Position</label>
                    <select id="position" name="position" class="form-control" required>
                        <option value="Stock Manager" <?php echo $employee['position'] == 'Stock Manager' ? 'selected' : ''; ?>>Stock Manager</option>
                        <option value="Warehouse Manager" <?php echo $employee['position'] == 'Warehouse Manager' ? 'selected' : ''; ?>>Warehouse Manager</option>
                        <option value="Human Resource" <?php echo $employee['position'] == 'Human Resource' ? 'selected' : ''; ?>>Human Resource</option>
                        <option value="Customer Manager" <?php echo $employee['position'] == 'Customer Manager' ? 'selected' : ''; ?>>Customer Manager</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="hired_date">Hired Date</label>
                    <input type="date" id="hired_date" name="hired_date" class="form-control" value="<?php echo htmlspecialchars($employee['hired_date']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="contract_type">Contract Type</label>
                    <select id="contract_type" name="contract_type" class="form-control" required>
                        <option value="full_time" <?php echo $employee['contract_type'] == 'full_time' ? 'selected' : ''; ?>>Full-time</option>
                        <option value="part_time" <?php echo $employee['contract_type'] == 'part_time' ? 'selected' : ''; ?>>Part-time</option>
                        <option value="temporary" <?php echo $employee['contract_type'] == 'temporary' ? 'selected' : ''; ?>>Temporary</option>
                        <option value="internship" <?php echo $employee['contract_type'] == 'internship' ? 'selected' : ''; ?>>Internship</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="contract_length">Contract Length (Months)</label>
                    <input type="number" id="contract_length" name="contract_length" class="form-control" value="<?php echo htmlspecialchars($employee['contract_length']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="bank_name">Bank Name</label>
                    <select id="bank_name" name="bank_name" class="form-control" required>
                        <option value="equity" <?php echo $employee['bank_name'] == 'equity' ? 'selected' : ''; ?>>Equity</option>
                        <option value="bk" <?php echo $employee['bank_name'] == 'bk' ? 'selected' : ''; ?>>BK</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="bank_account_number">Bank Account Number</label>
                    <input type="text" id="bank_account_number" name="bank_account_number" class="form-control" value="<?php echo htmlspecialchars($employee['bank_account_number']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="status">Status</label>
                    <input type="text" id="status" name="status" class="form-control" value="<?php echo htmlspecialchars($employee['status']); ?>" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
            </div>
            <div class="btn-center">
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
