
<?php include ("../includes/header.php") ?>
<?php include ("../../../objects/product/category/veiw_category.php") ?>
<?php


require_once '../../../objects/employee/stock/veiw_stock.php'; // Assuming the Stock class file path is correct

// Instantiate database and stock object
$database = new Database();
$db = $database->getConnection();
$stock = new Stock($db);

// Retrieve all stocks
$Stocks = $stock->read();
?>
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
          <?php
                if (isset($error)) {
                    echo '<div class="alert alert-danger">' . htmlspecialchars($error) . '</div>';
                }
                if (isset($success)) {
                    echo '<div class="alert alert-success">' . htmlspecialchars($success) . '</div>';
                }
                ?>

            <h5 class="mb-1"><b>Add Product</b></h5> 
    

        <form action="../../../objects/product/product/addproduct.php" method="post" class="needs-validation form-shadow" novalidate enctype="multipart/form-data">
            <div class="form-group row">
                <label for="productName" class="col-sm-2 col-form-label">Product Name:</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="productName" name="productName" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the product name.
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="productImage" class="col-sm-2 col-form-label">Product Image:</label>
                <div class="col-sm-6">
                    <input type="file" class="form-control" id="productImage" name="productImage" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the product name.
                    </div>
                </div>
            </div><br>

            <div class="form-group row">
                <label for="supplyPrice" class="col-sm-2 col-form-label">Supply Price:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="supplyPrice" name="supplyPrice" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the supply price.
                    </div>
                </div>
            </div><br>

            <div class="form-group row">
                <label for="sellingPrice" class="col-sm-2 col-form-label" >Selling Price:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="sellingPrice" name="sellingPrice" value="0" required readonly>
                    <div class="invalid-feedback"style="margin-left:600px;margin-top:-5%;">
                        Please enter the selling price.
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="productCategory" class="col-sm-2 col-form-label">Product Category:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="productCategory" name="productCategory" required>
                        <option value="">Select a category </option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo htmlspecialchars($category['id']); ?>">
                                <?php echo htmlspecialchars($category['categoryName']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please select a product category.
                    </div>
                </div>
            </div><br>

            <div class="form-group row">
                <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                <div class="col-sm-6">
                    <input type="number" class="form-control" id="quantity" name="quantity" required>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the quantity.
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="stock" class="col-sm-2 col-form-label">Product stock:</label>
                <div class="col-sm-6">
                    <select class="form-control" id="stock" name="stock" required>
                        <option value="">Select a stock and location</option>
                            <?php foreach($Stocks as $Stock): ?>
                            <option value="<?php echo htmlspecialchars($Stock['id']); ?>">
                                <?php echo htmlspecialchars($Stock['category']); ?>
                                <?php echo htmlspecialchars($Stock['location']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please select a product category.
                    </div>
                </div>
            </div><br>
            <div class="form-group row">
                <label for="productDescription" class="col-sm-2 col-form-label">Product Description:</label>
                <div class="col-sm-6">
                    <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                    <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                        Please enter the product description.
                    </div>
                </div>
            </div><br>

            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button type="submit" class="btn btn-primary">Add Product</button>

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