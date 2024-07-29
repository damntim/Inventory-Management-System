<?php include("../includes/header.php") ?>
<div class="container-fluid">
  <div class="row">
    <?php include("includes/navbar.php") ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

        <div class="d-flex align-items-center">
          <div class="profile-container">
            <img src="../../../images/employees/2.jpg" alt="Profile Picture" class="profile-img rounded-5" onclick="toggleDropdown()" style="width: 40px; height: 40px; border-radius: 50%;">
            <!-- shyiramo ifoto ivuye muri session yumukozi winjiye -->
            <div class="user-menu-content">
              <a href="editprofile.php">Edit Profile</a>
              <a href="change_password.php">Change Password</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
          <div class="btn-toolbar mb-2 mb-md-0 ms-3">
            <!-- Additional buttons or content can go here -->
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Current Stock</h2>
        <button onclick="window.location.href='add_stock.php'" class="btn btn-primary">Add Stock</button>
      </div>

      <div class="table-responsive small">
        <!-- <p class="">Your Contents here please!!!</p> -->

        <?php
        require '../../../config/Database.php'; // Ensure this path is correct for including your Database.php file

        // Create an instance of the Database class
        $database = new Database();
        $conn = $database->getConnection();

        // Check connection
        if ($conn === null) {
            die("Connection failed: Unable to establish a database connection");
        }

        // Fetch all stock
        try {
            $stmt = $conn->query("SELECT * FROM stock");
            $stock = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Error fetching stock data: " . $e->getMessage());
        }
        ?>

        <table class="table">
          <thead>
              <tr>
                  <th>Product ID</th>
                  <th>Quantity</th>
                  <th>Last Updated</th>
                  <th>Category</th>
                  <th>Location</th>
                  <th>Actions</th>
              </tr>
          </thead>
          <tbody>
              <?php
              if (count($stock) > 0) {
                  foreach ($stock as $row) {
                      echo "<tr>
                          <td>{$row['ProductId']}</td>
                          <td>{$row['Quantity']}</td>
                          <td>{$row['LastUpdated']}</td>
                          <td>{$row['Category']}</td>
                          <td>{$row['Location']}</td>
                          <td>
                              <a href='view_stock.php?id={$row['ProductId']}' class='btn btn-info btn-sm'>View</a>
                              <a href='update_stock.php?id={$row['ProductId']}' class='btn btn-warning btn-sm'>Update</a>
                              <a href='delete_stock.php?id={$row['ProductId']}' class='btn btn-danger btn-sm'>Delete</a>
                          </td>
                      </tr>";
                  }
              } else {
                  echo "<tr><td colspan='6'>No records found</td></tr>";
              }
              ?>
          </tbody>
        </table>
        <?php
        // Close connection
        $conn = null;
        ?>
      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
