<html>
    <head>
    <style>
        .form-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            padding: 20px;
           font-weight:bold;
            border-radius: 8px;
        }
    </style>
    </head>
    <body>
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

            <h5 class="mb-1"><b>Add Product Category</b></h5> 
   

        <form action="../../../objects/employee/stock/add_stock.php" method="post" class="needs-validation form-shadow" novalidate >
            <div class="form-group row">
                <label for="StockCategory" class="col-sm-2 col-form-label">Stock Category:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="StockCategory" name="StockCategory" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the category name.
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="StockLocation" class="col-sm-2 col-form-label">Stock Location:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="StockLocation" name="StockLocation" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the category name.
                    </div>
                </div>
            </div><br>

            <div class="form-group row">
                <label for="StockDescription" class="col-sm-2 col-form-label">Stock Description:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="StockDescription" name="StockDescription" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the Stock description.
                    </div>
                </div>
            </div><br>



       

            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button type="submit" class="btn btn-primary">Add Stock </button>

                </div>
            </div>
        </form>
    </div>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </main>
  </div>
</div>
<?php include("includes/footer.php") ?>
    </body>
    </html>