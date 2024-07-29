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
      <div class="container">

            <h5 class="mb-1"><b>View Products</b></h5> 
            <div class="row" style="margin-left:70%;margin-top:-3.3%;box-shadow;">
                <div class="col-sm-8 offset-sm-4">
                 
                    <a href="addproduct.php" class="btn btn-secondary">Add New Product</a>
                </div>
            </div>
    


















      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
