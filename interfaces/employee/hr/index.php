<<<<<<< Updated upstream:interfaces/employee/hr/index.php
<?php include ("../includes/header.php") ?>
<div class="container-fluid">
  <div class="row">
    <?php include("includes/navbar.php")?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
        <div class="d-flex align-items-center">
          <div class="profile-container">
            
            <img src="../../../images/employees/2.jpg" alt="Profile Picture" class="profile-img rounded-5" onclick="toggleDropdown()" style="width: 40px; height: 40px; border-radius: 50%;">
            <!-- shyiramo ifoto ivuye muri session yumukozi winjiye -->
            <div class="user-menu-content">
            <a href="eidtprofile.php">Edit Profile</a>
            <a href="change_password.php">Change Password</a>
            <a href="logout.php">Logout</a>
        </div>
          </div>
          <div class="btn-toolbar mb-2 mb-md-0 ms-3">
            <!-- Additional buttons or content can go here -->
          </div>
        </div>
      </div>

      <h2>Section title</h2>
      <div class="table-responsive small">
        <p class="">Your Contents here please!!!</p>
      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
=======
<?php include ("../includes/header.php") ?>

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
        <h5 class="mb-1"><b>View Categories</b></h5> 
        <div class="row" style="margin-left:70%;margin-top:-3.3%;box-shadow;">
          <div class="col-sm-8 offset-sm-4">
            <a href="addcategory.php" class="btn btn-secondary">Add New Category</a>
          </div>
        </div>

        <table class="table table-striped mt-3">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Name</th>
              <th>Category Description</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require_once '../../../objects/product/cataegory/veiw_category.php'; // Include the PHP script to fetch categories
            foreach($categories as $category): ?>
              <tr>
                <td><?php echo $category['id']; ?></td>
                <td><?php echo $category['categoryName']; ?></td>
                <td><?php echo $category['categoryDescription']; ?></td>
                <td><?php echo $category['created_at']; ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <nav aria-label="Page navigation">
          <ul class="pagination justify-content-center">
            <?php if($page > 1): ?>
              <li class="page-item">
                <a class="page-link" href="viewcategory.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                  <span aria-hidden="true">&laquo; Previous</span>
                </a>
              </li>
            <?php endif; ?>

            <?php for($i = 1; $i <= $total_pages; $i++): ?>
              <li class="page-item <?php if($i == $page) echo 'active'; ?>"><a class="page-link" href="viewcategory.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <?php if($page < $total_pages): ?>
              <li class="page-item">
                <a class="page-link" href="viewcategory.php?page=<?php echo $page+1; ?>" aria-label="Next">
                  <span aria-hidden="true">Next &raquo;</span>
                </a>
              </li>
            <?php endif; ?>
          </ul>
        </nav>
        
      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
>>>>>>> Stashed changes:interfaces/employee/pm/viewcategory.php
