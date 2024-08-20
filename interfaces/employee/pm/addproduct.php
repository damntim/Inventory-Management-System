<?php
include ("../includes/header.php");
include ("../../../objects/product/category/veiw_category.php");
require_once '../../../objects/employee/warehouse/veiw_warehouse.php'; // Assuming the warehouse class file path is correct
require_once '../../../objects/product/product/Product.php'; // Assuming the Product class file path is correct

// Instantiate database and warehouse object
$database = new Database();
$db = $database->getConnection();
$warehouse = new warehouse($db);
$product = new Product($db);
$categories=new Category($db);
// Retrieve all warehouses
$warehouses = $warehouse->read();
$categories = $categories->getAllCategories(); // Make sure $categories is populated properly from veiw_category.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $productName = $_POST['productName'];
    $productImage = $_FILES['productImage'];
    $productCategory = $_POST['productCategory'];
    $warehouse = $_POST['warehouse'];
    $productDescription = $_POST['productDescription'];

    // Handle file upload
    $targetDir = "../../../images/products/";
    $targetFile = $targetDir . basename($productImage["name"]);
    if (move_uploaded_file($productImage["tmp_name"], $targetFile)) {
        // File upload successful, proceed to insert product
        $product->product_name = $productName;
        $product->description = $productDescription;
        $product->warehouse_id = $warehouse;
        $product->category_id = $productCategory;
        $product->product_image = basename($productImage["name"]);

        if ($product->addProduct()) {
            echo "<div class='alert alert-success'>Product added successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to add product.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Sorry, there was an error uploading your file.</div>";
    }
}
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
                    <div class="btn-toolbar mb-2 mb-md-0 ms-3"></div>
                </div>
            </div>
            <div class="container">
                <h5 class="mb-1"><b>Add Product</b></h5>
                <form action="" method="post" class="needs-validation form-shadow" enctype="multipart/form-data" novalidate>
                    <div class="form-group row">
                        <label for="productName" class="col-sm-2 col-form-label">Product Name:</label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="productName" name="productName" required>
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">Please enter the product name.</div>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="productImage" class="col-sm-2 col-form-label">Product Image:</label>
                        <div class="col-sm-6">
                            <input type="file" class="form-control" id="productImage" name="productImage" required>
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">Please enter the product image.</div>
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
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">Please select a product category.</div>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="warehouse" class="col-sm-2 col-form-label">Product Warehouse:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="warehouse" name="warehouse" required>
                                <option value="">Select a warehouse and location</option>
                                <?php foreach($warehouses as $warehouse): ?>
                                    <option value="<?php echo htmlspecialchars($warehouse['id']); ?>">
                                        <?php echo htmlspecialchars($warehouse['category']); ?>
                                        <?php echo htmlspecialchars($warehouse['location']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">Please select a product category.</div>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="productDescription" class="col-sm-2 col-form-label">Product Description:</label>
                        <div class="col-sm-6">
                            <textarea class="form-control" id="productDescription" name="productDescription" required></textarea>
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">Please enter the product description.</div>
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
