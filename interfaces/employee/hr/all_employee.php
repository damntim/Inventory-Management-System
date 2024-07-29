<?php

include ("../includes/header.php");

include("../../../objects/employee/hr/getlogged_employee.php");

?>

<div class="container-fluid">
  <div class="row">
    <?php include("includes/navbar.php")?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
        <div class="d-flex align-items-center">
          <div class="search-container me-3">
            <input type="text" id="searchInput" placeholder="Search..." onkeyup="searchTable()">
            <i class="fas fa-search search-icon" onclick="searchTable()"></i>
          </div>
          <div class="profile-container">
         <a href="edit_employee.php?id=<?php echo htmlspecialchars($_SESSION['employee_id']); ?>">
          <img src="../../../images/employees/<?php echo htmlspecialchars($_SESSION['image']); ?>" alt="Profile Picture" class="profile-img rounded-5" style="width: 40px; height: 40px; border-radius: 50%;"></a>
          </div>
        </div>
      </div>

      <div class="table-responsive small">
        <div class="content d-flex justify-content-between align-items-center">
          <h1>List of All Employees</h1>
          <a href="add_employee.php" class="btn btn-primary btn-sm">Add New Employee</a>
        </div>
          
        <table class="table table-striped" id="employeeTable">
          <thead>
            <tr>
              <th>Emp ID</th>
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
                  <a href="../../../objects/employee/hr/delete_employee.php?id=<?php echo urlencode($employee['employee_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>

      <script>
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
      </script>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
