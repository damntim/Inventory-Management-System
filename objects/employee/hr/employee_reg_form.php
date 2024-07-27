<?php
require '../../../db.php'; // Ensure this file contains the PDO instance
session_start(); // Start the session to access logged-in user ID

if (!isset($_SESSION['employee_id'])) {
    echo "Employee ID is not set in session.";
    exit();
}

// Fetch employees from the database, excluding the logged-in user
$stmt = $pdo->prepare("SELECT * FROM employees WHERE employee_id != :logged_in_employee_id");
$stmt->execute(['logged_in_employee_id' => $_SESSION['employee_id']]);
$employees = $stmt->fetchAll();

// Fetch logged-in user profile image
$stmt = $pdo->prepare("SELECT image FROM employees WHERE employee_id = :logged_in_employee_id");
$stmt->execute(['logged_in_employee_id' => $_SESSION['employee_id']]);
$loggedInUser = $stmt->fetch();

$profileImagePath = !empty($loggedInUser['image']) ? '../../../images/employees/'. htmlspecialchars($loggedInUser['image']) : 'default_profile.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="styles.css" rel="stylesheet">
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

<div class="sidebar">
    <div class="profile-container">
        <img src="<?php echo $profileImagePath; ?>" alt="Profile Picture" class="profile-img" onclick="toggleDropdown()">
        <div class="dropdown-menu" id="profileDropdown">
            <a class="dropdown-item" href="edit_employee.php?id=<?php echo urlencode($_SESSION['employee_id']); ?>">Edit Profile</a>
            <a class="dropdown-item" href="logout.php">Sign Out</a>
        </div>
    </div>
    <div class="menu-title">Menu</div>
    <a href="hrdashboard.php"><i class="fas fa-home"></i> Home</a>
    <a href="javascript:void(0)" class="dropdown-btn" onclick="toggleEmployeeDropdown()"><i class="fas fa-users"></i> Employees</a>
    <div class="dropdown-container" id="employeeDropdown">
        <a href="list_of_all_employees.php">All Employees</a>
        <a href="employee_reg_form.php">Add Employee</a>
    </div>
</div>

<div class="content">


    <div class="container">
    <h2 class="text-center mt-5">Employee Registration Form</h2>
    <form action="create_employee.php" method="post" class="form-wrapper" enctype="multipart/form-data">
        <div class="form-section row">
            <h3 class="col-12">Personal Information</h3>
            <div class="form-group col-md-6">
                <label for="employee_id">Employee ID</label>
                <input type="text" id="employee_id" name="employee_id" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="gmail">Gmail</label>
                <input type="email" id="gmail" name="gmail" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="resident_gps">Resident GPS</label>
                <input type="text" id="resident_gps" name="resident_gps" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="image" class="form-control" required>
            </div>
        </div>
        <div class="form-section row">
            <h3 class="col-12">Job Information</h3>
            <div class="form-group col-md-6">
                <label for="position">Position</label>
                <select id="position" name="position" class="form-control" required>
                    <option value="Stock Manager">Stock Manager</option>
                    <option value="Warehouse Manager">Warehouse Manager</option>
                    <option value="Human Resource">Human Resource</option>
                    <option value="Customer Manager">Customer Manager</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="hired_date">Hired Date</label>
                <input type="date" id="hired_date" name="hired_date" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="contract_type">Contract Type</label>
                <select id="contract_type" name="contract_type" class="form-control" required>
                    <option value="full_time">Full-time</option>
                    <option value="part_time">Part-time</option>
                    <option value="temporary">Temporary</option>
                    <option value="internship">Internship</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="contract_length">Contract Length (Months)</label>
                <input type="number" id="contract_length" name="contract_length" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="bank_name">Bank Name</label>
                <select id="bank_name" name="bank_name" class="form-control" required>
                    <option value="equity">Equity</option>
                    <option value="bk">BK</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="bank_account_number">Bank Account Number</label>
                <input type="text" id="bank_account_number" name="bank_account_number" class="form-control" required>
            </div>
            <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control" value="active" required>
            </div>
            <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
        </div>
        <div class="btn-center">
            <button type="submit" class="btn btn-primary">Add Employee</button>
        </div>
    </form>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    function toggleDropdown() {
        document.getElementById("profileDropdown").classList.toggle("show");
    }

    function toggleEmployeeDropdown() {
        document.getElementById("employeeDropdown").classList.toggle("show");
    }


    window.onclick = function(event) {
        if (!event.target.matches('.profile-container img') && !event.target.matches('.dropdown-btn')) {
            var profileDropdown = document.getElementById("profileDropdown");
            var employeeDropdown = document.getElementById("employeeDropdown");

            if (profileDropdown.classList.contains('show')) {
                profileDropdown.classList.remove('show');
            }
            if (employeeDropdown.classList.contains('show')) {
                employeeDropdown.classList.remove('show');
            }
        }
    }
</script>


</body>
</html>
