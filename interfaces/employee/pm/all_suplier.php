<?php
include ("../includes/header.php");
require_once '../../../config/database.php';
require_once '../../../objects/partner/supplier/Supplier.php'; // Assuming the correct file path for Supplier class

// Instantiate database and supplier object
$database = new Database();
$db = $database->getConnection();
$supplier = new Supplier($db);

// Retrieve all suppliers
$suppliers = $supplier->getSupplier()->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container-fluid">
  <div class="row">
    <?php include("includes/navbar.php")?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
        <div class="d-flex align-items-center">
          <div class="profile-container">
            <img src="../../../images/employees/2.jpg" alt="Profile Picture" class="profile-img rounded-5" onclick="toggleDropdown()" style="width: 40px; height: 40px; border-radius: 50%;">
            <div class="user-menu-content">
              <a href="editprofile.php">Edit Profile</a>
              <a href="change_password.php">Change Password</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
          <div class="btn-toolbar mb-2 mb-md-0 ms-3">
          </div>
        </div>
      </div>
      <div class="container">
        <h5 class="mb-1"><b>View Suppliers</b></h5> 
        <div class="row" style="margin-left:70%;margin-top:-3.3%;box-shadow;">
          <div class="col-sm-8 offset-sm-4">
            <a href="addsupplier.php" class="btn btn-secondary">Add New Supplier</a>
          </div>
        </div>
        <table class="table table-striped mt-3">
  <thead>
    <tr>
      <th>ID</th>
      <th>TIN</th>
      <th>Full Name</th>
      <th>Email</th>
      <th>Address</th>
      <th>Action</th>
  </thead>
  <tbody>
    <?php if (!empty($suppliers)): ?>
      <?php foreach ($suppliers as $supplier): ?>
        <tr>
          <td><?php echo htmlspecialchars($supplier['id']); ?></td>
          <td><?php echo htmlspecialchars($supplier['tin']); ?></td>
          <td><?php echo htmlspecialchars($supplier['fullname']); ?></td>
          <td><?php echo htmlspecialchars($supplier['email']); ?></td>
          <td><?php echo htmlspecialchars($supplier['address']); ?></td>
          <td> 
            <a href="edit_supplier.php?id=<?php echo $supplier['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
            <a href="delete_supplier.php?id=<?php echo $supplier['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this supplier?');">Delete</a>
          </td>
        </tr>
      <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="6">No suppliers found.</td> 
      </tr>
    <?php endif; ?>
  </tbody>
</table>

        
      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
