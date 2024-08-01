<?php
include("../includes/header.php");
require_once '../../../objects/product/stockin/Stockin.php';
require_once '../../../objects/product/product/Product.php';
include ("../../../objects/product/category/veiw_category.php");
require_once '../../../objects/employee/stock/veiw_stock.php'; // Assuming the Stock class file path is correct
require_once '../../../objects/product/product/Product.php'; // Assuming the Product class file path is correct
// Instantiate database and objects
$database = new Database();
$db = $database->getConnection();
$stockin = new Stockin($db);
$product = new Product($db);

// Fetch products
$products = $product->getProducts();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stockin->product_id = $_POST['product_id'];
    $stockin->quantity = $_POST['quantity'];

    // Create stockin record
    if ($stockin->create()) {
        echo "<div class='alert alert-success'>Stockin added</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to add stock. Please try again.</div>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include("includes/navbar.php") ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Stock In</h1>
            </div>
            <div class="container">
                <form action="" method="post" class="needs-validation form-shadow" novalidate>
                    <div class="form-group row">
                        <label for="product_id" class="col-sm-2 col-form-label">Product:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="">Select a product</option>
                                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?php echo htmlspecialchars($row['product_id']); ?>">
                                        <?php echo htmlspecialchars($row['product_name']); ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a product.
                            </div>
                        </div>
                    </div><br>


                    <div class="form-group row">
                        <label for="quantity" class="col-sm-2 col-form-label">Quantity:</label>
                        <div class="col-sm-6">
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                            <div class="invalid-feedback">
                                Please enter the quantity.
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Add Stock</button>
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
