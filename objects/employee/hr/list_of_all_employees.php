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
    <a href="javascript:void(0)" class="dropdown-btn" onclick="toggleEmployeeDropdown()"><i class="fas fa-users"></i> Employees</a>
    <div class="dropdown-container" id="employeeDropdown">
        <a href="list_of_all_employees.php">All Employees</a>
        <a href="employee_reg_form.html">Add Employee</a>
    </div>
</div>

<div class="content">
<div class="search-container">
        <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
        <i class="fas fa-search search-icon" onclick="searchTable()"></i>
    </div>
    <h1>List of All Employees</h1>
    
    <table class="table table-striped" id="employeeTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Gmail</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Gender</th>
                <th>Resident GPS</th>
                <th>Image</th>
                <th>Position</th>
                <th>Hired Date</th>
                <th>Contract Type</th>
                <th>Contract Length (Months)</th>
                <th>Bank Name</th>
                <th>Bank Account Number</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?php echo htmlspecialchars($employee['employee_id']); ?></td>
                    <td><?php echo htmlspecialchars($employee['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['gmail']); ?></td>
                    <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                    <td><?php echo htmlspecialchars($employee['dob']); ?></td>
                    <td><?php echo htmlspecialchars($employee['gender']); ?></td>
                    <td><?php echo htmlspecialchars($employee['resident_gps']); ?></td>
                    <td>
                        <?php if ($employee['image']): ?>
                            <img src="../../../images/employees/<?php echo htmlspecialchars($employee['image']); ?>" alt="Profile Image" style="width: 50px; height: auto;">
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($employee['position']); ?></td>
                    <td><?php echo htmlspecialchars($employee['hired_date']); ?></td>
                    <td><?php echo htmlspecialchars($employee['contract_type']); ?></td>
                    <td><?php echo htmlspecialchars($employee['contract_length']); ?></td>
                    <td><?php echo htmlspecialchars($employee['bank_name']); ?></td>
                    <td><?php echo htmlspecialchars($employee['bank_account_number']); ?></td>
                    <td><?php echo htmlspecialchars($employee['status']); ?></td>
                    <td>
                        <a href="edit_employee.php?id=<?php echo urlencode($employee['employee_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="delete_employee.php?id=<?php echo urlencode($employee['employee_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
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

    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue, matched;
        input = document.getElementById("searchInput");
        filter = input.value.toLowerCase();
        table = document.getElementById("employeeTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, starting from the second row (index 1) to skip the header
        for (i = 1; i < tr.length; i++) {
            tr[i].style.display = "none"; // Start by hiding the row
            td = tr[i].getElementsByTagName("td");
            matched = false;

            // Check Full Name (index 1), Position (index 8), and Contract Type (index 10)
            var indices = [1, 8, 10];
            for (j = 0; j < indices.length; j++) {
                var idx = indices[j];
                if (td[idx]) {
                    txtValue = td[idx].textContent || td[idx].innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        matched = true;
                        break;
                    }
                }
            }

            // If a match was found, display the row
            if (matched) {
                tr[i].style.display = "";
            }
        }
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
