<?php
include("../includes/header.php");
require_once '../../../objects/employee/price/Price.php';
require_once '../../../objects/product/product/Product.php';
require_once '../../../objects/partner/customer/Customer.php';
require_once '../../../objects/partner/supplier/Supplier.php';
require_once '../../../objects/product/category/veiw_category.php';
require_once '../../../objects/employee/stock/veiw_stock.php';
// Instantiate database and objects
$database = new Database();
$db = $database->getConnection();
$price = new Price($db);
$product = new Product($db);
$customer = new Customer($db);
$supplier = new Supplier($db);

// Fetch products
$products = $product->getProduct();

// Fetch customers and suppliers
$customers = $customer->getCustomers();
$suppliers = $supplier->getSupplier();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $price->productID = $_POST['productID'];
    $price->amount = $_POST['amount'];
    $price->pricetype = $_POST['pricetype'];
    $price->taxrate = $_POST['taxrate'];
    $price->discount = $_POST['discount'];

    if ($price->pricetype == 'selling') {
        $price->paternerID = $_POST['customerID'];
    } else {
        $price->paternerID = $_POST['supplierID'];
    }

    // Calculate net price
    $price->netprice = $price->amount * (1 + $price->taxrate / 100) * (1 - $price->discount / 100);

    // Create price record
    if ($price->addPrice()) {
        // header("Location: view_prices.php");
        echo "<div class='alert alert-success'>Price added</div>";
        exit;
    } else {
        echo "<div class='alert alert-danger'>Unable to add price. Please try again.</div>";
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include("includes/navbar.php") ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Add Price</h1>
            </div>
            <div class="container">
                <form action="" method="post" class="needs-validation form-shadow" novalidate>
                    <div class="form-group row">
                        <label for="productID" class="col-sm-2 col-form-label">Product:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="productID" name="productID" required>
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
                        <label for="amount" class="col-sm-2 col-form-label">ActualPrice:</label>
                        <div class="col-sm-6">
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                            <div class="invalid-feedback">
                                Please enter the amount.
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="pricetype" class="col-sm-2 col-form-label">Price Type:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="pricetype" name="pricetype" required>
                                <option value="">Select price type</option>
                                <option value="selling">Selling Price</option>
                                <option value="purchase">Purchase Price</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a price type.
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group row" id="">
                        <label for="partnerID" class="col-sm-2 col-form-label">Partner:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="customerID" name="customerID" style="display:none;" required>
                                <option value="">Select a customer</option>
                                <?php while ($row = $customers->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <?php echo htmlspecialchars($row['fullname']); ?>
                                    </option>
                                <?php endwhile; ?>
                                <option value="0">
                                        Regular customers
                                    </option>
                            </select>
                            <select class="form-control" id="supplierID" name="supplierID" style="display:none;" required>
                                <option value="">Select a supplier</option>
                                
                                <?php while ($row = $suppliers->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                                        <?php echo htmlspecialchars($row['fullname']); ?>
                                    </option>
                                <?php endwhile; ?>

                            </select>
                            <div class="invalid-feedback">
                                Please select a partner.
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="taxrate" class="col-sm-2 col-form-label">Tax Rate (%):</label>
                        <div class="col-sm-6">
                            <input type="number" step="0.01" class="form-control" id="taxrate" name="taxrate" required>
                            <div class="invalid-feedback">
                                Please enter the tax rate.
                            </div>
                        </div>
                    </div><br>

                    <div class="form-group row">
                        <label for="discount" class="col-sm-2 col-form-label">Discount (%):</label>
                        <div class="col-sm-6">
                            <input type="number" step="0.01" class="form-control" id="discount" name="discount" required>
                            <div class="invalid-feedback">
                                Please enter the discount.
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                            <button type="submit" class="btn btn-primary">Add Price</button>
                        </div>
                    </div>
                </form>
            </div>

            <script>
                (function() {

                    document.getElementById('pricetype').addEventListener('change', function() {
                        var type = this.value;
                        var customerSelect = document.getElementById('customerID');
                        var supplierSelect = document.getElementById('supplierID');
                        if (type === 'selling') {
                            customerSelect.style.display = 'block';
                            supplierSelect.style.display = 'none';
                        } else if (type === 'purchase') {
                            customerSelect.style.display = 'none';
                            supplierSelect.style.display = 'block';
                        } else {
                            customerSelect.style.display = 'none';
                            supplierSelect.style.display = 'none';
                        }
                    });
                })();
            </script>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </main>
    </div>
</div>

<?php include("includes/footer.php") ?>
