<?php


include("../includes/header.php");
include("../../../objects/employee/hr/get_employee.php");
?>

<div class="container-fluid">
  <div class="row">
    <?php include("includes/navbar.php")?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
        <div class="d-flex align-items-center">
          <div class="profile-container">
          <a href="edit_employee.php?id=<?php echo htmlspecialchars($_SESSION['employee_id']); ?>">
          <img src="../../../images/employees/<?php echo htmlspecialchars($_SESSION['image']); ?>" alt="Profile Picture" class="profile-img rounded-5" style="width: 40px; height: 40px; border-radius: 50%;"></a>
          </div>
          <div class="btn-toolbar mb-2 mb-md-0 ms-3">
            <!-- Additional buttons or content can go here -->
          </div>
        </div>
      </div>

      <div class="table-responsive small">
        <div class="content">
          <h2 class="text-center mt-5">Edit Employee</h2>
          <form action="../../../objects/employee/hr/edit_employees.php" method="POST" class="form-wrapper" enctype="multipart/form-data">
            <input type="hidden" name="employee_id" value="<?php echo htmlspecialchars($employee_id); ?>">
            <div class="form-section row">
              <h3 class="col-12">Personal Information</h3>
              <div class="form-group col-md-6">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" class="form-control" value="<?php echo htmlspecialchars($employee_data['full_name']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="gmail">Gmail</label>
                <input type="email" id="gmail" name="gmail" class="form-control" value="<?php echo htmlspecialchars($employee_data['gmail']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" class="form-control" value="<?php echo htmlspecialchars($employee_data['phone']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" name="dob" class="form-control" value="<?php echo htmlspecialchars($employee_data['dob']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" class="form-control" required>
                  <option value="Male" <?php if ($employee_data['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                  <option value="Female" <?php if ($employee_data['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="resident_gps">Resident GPS</label>
                <input type="text" id="resident_gps" name="resident_gps" class="form-control" value="<?php echo htmlspecialchars($employee_data['resident_gps']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="image">Profile Image</label>
                <input type="file" id="image" name="image" class="form-control">
              </div>
            </div>
            <div class="form-section row">
              <h3 class="col-12">Job Information</h3>
              <div class="form-group col-md-6">
                <label for="position">Position</label>
                <select id="position" name="position" class="form-control" required>
                  <option value="Stock Manager" <?php if ($employee_data['position'] == 'Stock Manager') echo 'selected'; ?>>Stock Manager</option>
                  <option value="Warehouse Manager" <?php if ($employee_data['position'] == 'Warehouse Manager') echo 'selected'; ?>>Warehouse Manager</option>
                  <option value="Human Resource" <?php if ($employee_data['position'] == 'Human Resource') echo 'selected'; ?>>Human Resource</option>
                  <option value="Customer Manager" <?php if ($employee_data['position'] == 'Customer Manager') echo 'selected'; ?>>Customer Manager</option>
                  <option value="Product Manager" <?php if ($employee_data['position'] == 'Product Manager') echo 'selected'; ?>>Product Manager</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="hired_date">Hired Date</label>
                <input type="date" id="hired_date" name="hired_date" class="form-control" value="<?php echo htmlspecialchars($employee_data['hired_date']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="contract_type">Contract Type</label>
                <select id="contract_type" name="contract_type" class="form-control" required>
                  <option value="full_time" <?php if ($employee_data['contract_type'] == 'full_time') echo 'selected'; ?>>Full-time</option>
                  <option value="part_time" <?php if ($employee_data['contract_type'] == 'part_time') echo 'selected'; ?>>Part-time</option>
                  <option value="temporary" <?php if ($employee_data['contract_type'] == 'temporary') echo 'selected'; ?>>Temporary</option>
                  <option value="internship" <?php if ($employee_data['contract_type'] == 'internship') echo 'selected'; ?>>Internship</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="contract_length">Contract Length (Months)</label>
                <input type="number" id="contract_length" name="contract_length" class="form-control" value="<?php echo htmlspecialchars($employee_data['contract_length']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="bank_name">Bank Name</label>
                <select id="bank_name" name="bank_name" class="form-control" required>
                  <option value="equity" <?php if ($employee_data['bank_name'] == 'equity') echo 'selected'; ?>>Equity</option>
                  <option value="bk" <?php if ($employee_data['bank_name'] == 'bk') echo 'selected'; ?>>BK</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="bank_account_number">Bank Account Number</label>
                <input type="text" id="bank_account_number" name="bank_account_number" class="form-control" value="<?php echo htmlspecialchars($employee_data['bank_account_number']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="status">Status</label>
                <input type="text" id="status" name="status" class="form-control" value="<?php echo htmlspecialchars($employee_data['status']); ?>" required>
              </div>
              <div class="form-group col-md-6">
                <label for="password">Password</label>
                <input type="text" id="password" name="password" class="form-control" value="<?php echo htmlspecialchars($employee_data['password']); ?>"  placeholder="NEW PASSOWD" required>
              </div>
            </div>
            <div class="btn-center">
              <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</div>

<?php include("includes/footer.php") ?>
