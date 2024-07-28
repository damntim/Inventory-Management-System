<?php

include ("../includes/header.php");
include ("../../../objects/employee/hr/getlogged.php");
?>
<div class="container-fluid">
  <div class="row">
    <?php include("includes/navbar.php")?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
        <div class="d-flex align-items-center">
          
          <div class="profile-container">
            <img src="../../../images/employees/<?php echo htmlspecialchars($_SESSION['image']); ?>" alt="Profile Picture" class="profile-img rounded-5" herf="#" style="width: 40px; height: 40px; border-radius: 50%;">
            
          </div>
          <div class="btn-toolbar mb-2 mb-md-0 ms-3">
            <!-- Additional buttons or content can go here -->
          </div>
        </div>
      </div>

      <div class="table-responsive small">
        <div class="content">
         
      </div>
      </div>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
