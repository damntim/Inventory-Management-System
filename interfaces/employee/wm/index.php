<?php
<<<<<<< HEAD

include ("../includes/header.php");
include ("../../../objects/employee/hr/getlogged.php");
=======
session_start();

include ("../includes/header.php");
include ("../../../objects/employee/hr/employee.php");

// Database connection
include '../../../config/Database.php';
$database = new Database();
$db = $database->getConnection();

$employee = new Employee($db);
$logged_in_employee_id = $_SESSION['employee_id']; // Get the logged-in employee's ID from session
$employees = $employee->listAllExceptLoggedIn($logged_in_employee_id); // Retrieve all employees except the logged-in one
>>>>>>> da8f4abd826d90d78c13415974d2fe26d15a93b4
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
