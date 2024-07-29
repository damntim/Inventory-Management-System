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
        <div class="profile-container">
            <div class="dropdown d-inline-block position-relative">
                <img id="profileImg" src="../../../images/employees/<?php echo htmlspecialchars($_SESSION['image']); ?>" alt="Profile Picture" class="profile-img rounded-5" style="width: 40px; height: 40px; border-radius: 50%; cursor: pointer;">
                <div id="dropdownMenu" class="dropdown-menu" style="display: none; position: absolute; top: 200%; left: 110%; transform: translate(-80%, -50%);">
                    <a class="dropdown-item" href="edit_employee.php?id=<?php echo htmlspecialchars($_SESSION['employee_id']); ?>">My Profile</a>
                    <a class="dropdown-item" href="newpass.php?id=<?php echo htmlspecialchars($_SESSION['employee_id']); ?>">Change Password</a>
                </div>
            </div>
          </div>

          <script>
              document.getElementById('profileImg').addEventListener('click', function() {
                  var menu = document.getElementById('dropdownMenu');
                  menu.style.display = menu.style.display === 'none' ? 'block' : 'none';
              });

              // Optional: Close the dropdown when clicking outside
              window.addEventListener('click', function(event) {
                  if (!event.target.matches('#profileImg')) {
                      var dropdowns = document.getElementsByClassName('dropdown-menu');
                      for (var i = 0; i < dropdowns.length; i++) {
                          var openDropdown = dropdowns[i];
                          if (openDropdown.style.display === 'block') {
                              openDropdown.style.display = 'none';
                          }
                      }
                  }
              });
          </script>

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
