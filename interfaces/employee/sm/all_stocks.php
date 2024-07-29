<?php
include ("../includes/header.php");
require_once '../../../config/database.php';
require_once '../../../objects/employee/stock/veiw_stock.php'; // Assuming the Stock class file path is correct

// Instantiate database and stock object
$database = new Database();
$db = $database->getConnection();
$stock = new Stock($db);

// Retrieve all stocks
$Stocks = $stock->read();
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
        <h5 class="mb-1"><b>View stocks</b></h5> 
        <div class="row" style="margin-left:70%;margin-top:-3.3%;box-shadow;">
          <div class="col-sm-8 offset-sm-4">
            <a href="addStock.php" class="btn btn-secondary">Add New Stock</a>
          </div>
        </div>

        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>ID</th>
              <th>Stock Category</th>
              <th>Stock Location</th>
              <th>Stock Description</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php if(!empty($Stocks)): ?>
              <?php foreach($Stocks as $Stock): ?>
                <tr>
                  <td><?php echo htmlspecialchars($Stock['id']); ?></td>
                  <td><?php echo htmlspecialchars($Stock['category']); ?></td>
                  <td><?php echo htmlspecialchars($Stock['location']); ?></td>
                  <td><?php echo htmlspecialchars($Stock['description']); ?></td>
                  <td><?php echo htmlspecialchars($Stock['created_at']); ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5">No stocks found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
        
      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
