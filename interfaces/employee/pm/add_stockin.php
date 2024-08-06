<?php
include("../includes/header.php");
require_once '../../../objects/product/stockin/Stockin.php';
require_once '../../../objects/product/product/Product.php';
require_once '../../../objects/partner/supplier/Supplier.php';
require_once '../../../config/Database.php';

$database = new Database();
$db = $database->getConnection();
$stockin = new Stockin($db);
$product = new Product($db);
$supplier = new Supplier($db);

$products = $product->getProducts();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stockin->product_id = $_POST['product_id'];
    $stockin->quantity = $_POST['quantity'];
    $stockin->partner_id = $_POST['supplier_id'];

    // Fetch price details
    $price_details = $stockin->fetchPriceDetails($stockin->product_id, $stockin->partner_id);
    
    if ($price_details) {
        $stockin->amount = $price_details['amount'];
        $stockin->netprice = $price_details['netprice'];
        $stockin->totalprice = $price_details['netprice']*$stockin->quantity = $_POST['quantity'];
        $stockin->taxrate = $price_details['taxrate'];
        $stockin->discount = $price_details['discount'];
        
        // Calculate total price
        $total_price = $stockin->quantity * $stockin->netprice;

        // Create stockin record
        if ($stockin->create()) {
            echo "<div class='alert alert-success'>Purchase successful. Total Price: $$total_price</div>";
        } else {
            echo "<div class='alert alert-danger'>Unable to add stock. Please try again.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Unable to fetch price details. Please try again.</div>";
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
                <form id="addStockForm" action="" method="post" class="needs-validation form-shadow" novalidate>
                <div class="form-group row">
                        <label for="supplier_id" class="col-sm-2 col-form-label">Supplier:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="supplier_id" name="supplier_id" required>
                                <option value="">Select a supplier</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a supplier.
                            </div>
                        </div>
                    </div><br>
                    <div class="form-group row">
                        <label for="product_id" class="col-sm-2 col-form-label">Product:</label>
                        <div class="col-sm-6">
                            <select class="form-control" id="product_id" name="product_id" required>
                                <option value="">Select a product</option>
                                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?php echo htmlspecialchars($row['product_id']); ?>">
                                        <?php echo htmlspecialchars($row['product_name'].$row['product_id']);
                                        $supplier_id = isset($_GET['supplier_id']) ? $_GET['supplier_id'] : '';                                     
                                        ?> 
                                    </option>
                                <?php endwhile; ?>
                            </select>
                            <div class="invalid-feedback">
                                Please select a product.
                            </div>
                        </div>
                    </div><br>

                    <!-- Price Details (dynamically populated) -->
                    <div id="price-details" style="display:none;">
                        <div class="form-group row">
                            <label for="amount" class="col-sm-2 col-form-label">Actual Price:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="amount" name="amount" readonly>
                            </div>
                        </div><br>



                        <div class="form-group row">
                            <label for="taxrate" class="col-sm-2 col-form-label">Tax Rate:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="taxrate" name="taxrate" readonly>
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label for="discount" class="col-sm-2 col-form-label">Discount:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="discount" name="discount" readonly>
                            </div>
                        </div><br>

                        <div class="form-group row">
                            <label for="netprice" class="col-sm-2 col-form-label">Net Price:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" id="netprice" name="netprice" readonly>
                            </div>
                        </div><br>                        
                    </div>

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
                            <button type="submit" class="btn btn-primary">Purchase</button>
                        </div>
                    </div>
                </form>
            </div>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script>
$(document).ready(function() {
    $('#product_id').change(function() {
        var product_id = $(this).val();

        if (product_id) {
            $.ajax({
                url: 'get_product.php',
                type: 'GET',
                data: { product_id: product_id },
                dataType: 'json',
                success: function(response) {
                    console.log(response);  // Debug log to check the response
                    if (response.status === 'success') {
                        $('#supplier_id').empty().append('<option value="">Select a supplier from get supplier</option>');
                        $.each(response.supplier, function(index, supplier) {
                            $('#supplier_id').append('<option value="' + supplier.id + '">' + supplier.fullname + '</option>');
                        });
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('AJAX error: ' + error);
                }
            });
        } else {
            $('#supplier_id').empty().append('<option value="">Select a supplier</option>');
        }
    });

    $('#supplier_id').change(function() {
        var product_id = $('#product_id').val();
        var supplier_id = $(this).val();

        if (product_id && supplier_id) {
            $.ajax({
                url: 'get_price_details.php',
                type: 'GET',
                data: { product_id: product_id, supplier_id: supplier_id },
                dataType: 'json',
                success: function(response) {
                    console.log(response);  // Debug log to check the response
                    if (response.status === 'success') {
                        $('#amount').val(response.price_details.amount);
                        $('#netprice').val(response.price_details.netprice);
                        $('#taxrate').val(response.price_details.taxrate);
                        $('#discount').val(response.price_details.discount);
                        $('#price-details').show();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('AJAX error: ' + error);
                }
            });
        } else {
            $('#price-details').hide();
        }
    });
});
</script>

        </main>
    </div>
</div>

<?php include("includes/footer.php") ?>
