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
</head>
<body>

<div class="sidebar">
    <div class="profile-container">
        <img src="profile.jpg" alt="Profile Picture" onclick="toggleDropdown()">
        <div class="dropdown-menu" id="profileDropdown">
            <a class="dropdown-item" href="#">Edit Profile</a>
            <a class="dropdown-item" href="#">Sign Out</a>
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
    <h1>Welcome to HR Dashboard</h1>
</div>

<!-- Bootstrap JS and dependencies -->
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

    // Close the dropdown if the user clicks outside of it
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
