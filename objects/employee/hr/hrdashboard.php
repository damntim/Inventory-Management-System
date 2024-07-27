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
        .table { font-size: 12px; }
        .table th, .table td { padding: 8px; }
        .sidebar { width: 220px; }
        .sidebar .profile-img { width: 80px; height: 80px; }
        .content { margin-left: 220px; }
        .search-container { text-align: right; margin-bottom: 15px; position: fixed; right: 0; display: flex; align-items: center; }
        .search-container input { width: 200px; padding-right: 30px; }
        .search-container .search-icon { position: absolute; right: 10px; cursor: pointer; }
        .show { display: block !important; }
        .btn{
            display: block;
        
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
<div class="search-container">
        <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
        <i class="fas fa-search search-icon" onclick="searchTable()"></i>
    </div>
    <p >dashboard<p>

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
