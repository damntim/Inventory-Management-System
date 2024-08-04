<?php
include_once 'config.php'; // Ensure this path is correct

// Instantiate database and stock object
$database = new Database();
$db = $database->getConnection();
$stock = new Stock($db);

// Retrieve products with a selling price of 0
$Stocks = $stock->getProductsWithZeroPrice();

// Handle form submission for adding a new product price
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePrice'])) {
    // Retrieve and sanitize input
    $productId = isset($_POST['product']) ? htmlspecialchars($_POST['product']) : '';
    $sellingPrice = isset($_POST['sellingPrice']) ? htmlspecialchars($_POST['sellingPrice']) : '';

    // Basic validation
    if (empty($productId) || empty($sellingPrice)) {
        $error = "All fields are required.";
    } elseif (!is_numeric($sellingPrice) || $sellingPrice <= 0) {
        $error = "Invalid price.";
    } else {
        // Insert into database
        $query = "INSERT INTO product_prices (product_id, price) VALUES (:productId, :price)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':price', $sellingPrice);

        if ($stmt->execute()) {
            $success = "Product price added successfully.";
        } else {
            $error = "Failed to add product price. " . implode(" ", $stmt->errorInfo());
        }
    }
}

// Handle form submission for updating an existing product price in the products table
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePrice'])) {
    // Retrieve and sanitize input
    $productId = isset($_POST['product']) ? htmlspecialchars($_POST['product']) : '';
    $sellingPrice = isset($_POST['sellingPrice']) ? htmlspecialchars($_POST['sellingPrice']) : '';

    // Basic validation
    if (empty($productId) || empty($sellingPrice)) {
        $error = "All fields are required.";
    } elseif (!is_numeric($sellingPrice) || $sellingPrice <= 0) {
        $error = "Invalid price.";
    } else {
        // Update existing price in products table
        $query = "UPDATE products SET sellingPrice = :sellingPrice WHERE id = :productId";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':productId', $productId);
        $stmt->bindParam(':sellingPrice', $sellingPrice); // Ensure this matches the placeholder

        if ($stmt->execute()) {
            $success = "Product price updated successfully.";
        } else {
            $error = "Failed to update product price. " . implode(" ", $stmt->errorInfo());
        }
    }
}
?>
<html>
<head>
    <style>
        .form-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            padding: 20px;
            font-weight: bold;
            border-radius: 8px;
        }
    </style>
</head>
<body>
<?php include ("../includes/header.php") ?>
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

                <h5 class="mb-1"><b>Add or Update Product Price</b></h5>

                <form action="" method="post" class="needs-validation form-shadow" novalidate>
                    <div class="form-group row">
                        <label for="productID" class="col-sm-2 col-form-label">Product Id:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="product" name="product" required>
                                <option value="">Select Product</option>
                                <?php foreach ($Stocks as $Product): ?>
                                    <option value="<?php echo htmlspecialchars($Product['id']); ?>">
                                        <?php echo htmlspecialchars($Product['productName']) . ' (' . htmlspecialchars($Product['productCategory']) . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                                Please select a product.
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="productPrice" class="col-sm-2 col-form-label">Selling Price:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="sellingPrice" name="sellingPrice" required>
                            <div class="invalid-feedback" style="margin-left:600px;margin-top:-5%;">
                                Please enter the product price.
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                           
                            <button type="submit" name="updatePrice" class="btn btn-secondary">Update Product Price</button>
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
