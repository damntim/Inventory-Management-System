<?php
// session_start();
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

$suppliers = $supplier->getSupplier();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    if ($_POST['action'] == 'add_to_cart') {
        $quantity = $_POST['quantity'];
        $netprice = $_POST['netprice'];
        
        // Calculate total price
        $totalprice = $netprice * $quantity;
        
        $cart_item = [
            'supplier_id' => $_POST['supplier_id'],
            'supplier_name' => $_POST['supplier_name'],
            'product_id' => $_POST['product_id'],
            'product_name' => $_POST['product_name'],
            'quantity' => $quantity,
            'amount' => $_POST['amount'],
            'netprice' => $netprice,
            'taxrate' => $_POST['taxrate'],
            'discount' => $_POST['discount'],
            'totalprice' => $totalprice // Store total price in the cart
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = $cart_item;
        echo "<div class='alert alert-success'>Item added to cart.</div>";
    } elseif ($_POST['action'] == 'purchase_all') {
        foreach ($_SESSION['cart'] as $item) {
            $stockin->product_id = $item['product_id'];
            $stockin->quantity = $item['quantity'];
            $stockin->partner_id = $item['supplier_id'];
            $stockin->amount = $item['amount'];
            $stockin->netprice = $item['netprice'];
            $stockin->taxrate = $item['taxrate'];
            $stockin->discount = $item['discount'];
            $stockin->totalprice = $item['netprice'] * $stockin->quantity;
            
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
                if ($_POST['action'] == 'purchase_all') {
                    $partner_id = $_SESSION['cart'][0]['supplier_id']; // Assuming all cart items share the same partner (supplier)
                    if (!$stockin->createBulk($_SESSION['cart'], $partner_id)) {
                        echo "<div class='alert alert-danger'>Unable to add stock. Please try again.</div>";
                    } else {
                        $_SESSION['cart'] = []; // Clear the cart on successful transaction
                        echo "<div class='alert alert-success'>All items purchased successfully.</div>";
                    }
                }
            }
        }
        $_SESSION['cart'] = [];
        echo "<div class='alert alert-success'>All items purchased successfully.</div>";
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
                                <?php while ($row = $suppliers->fetch(PDO::FETCH_ASSOC)): ?>
                                    <option value="<?php echo htmlspecialchars($row['id']); ?>" data-name="<?php echo htmlspecialchars($row['fullname']); ?>">
                                        <?php echo htmlspecialchars($row['fullname']); ?>
                                    </option>
                                <?php endwhile; ?>
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
                            <input type="number" class="form-control" id="quantity" name="quantity" value="0" required>
                            <div class="invalid-feedback">
                                Please enter the quantity.
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-sm-8 offset-sm-4">
                            <input type="hidden" name="action" value="add_to_cart">
                            <input type="hidden" id="supplier_name" name="supplier_name">
                            <input type="hidden" id="product_name" name="product_name">
                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="container mt-5">
                <h2>Cart</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Supplier</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Net Price</th>
                            <th>Tax Rate</th>
                            <th>Discount</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
    <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
        <?php foreach ($_SESSION['cart'] as $key => $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['supplier_name']); ?></td>
                <td><?php echo htmlspecialchars($item['product_name']); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td><?php echo htmlspecialchars($item['amount']); ?></td>
                <td><?php echo htmlspecialchars($item['netprice']); ?></td>
                <td><?php echo htmlspecialchars($item['taxrate']); ?></td>
                <td><?php echo htmlspecialchars($item['discount']); ?></td>
                <td><?php echo htmlspecialchars($item['totalprice']); ?></td> <!-- Display total price -->

                <td>
                    <form action="deletecart.php" method="post">
                        <input type="hidden" name="item_key" value="<?php echo $key; ?>">
                        <button type="submit" class="btn btn-danger">Remove</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9">No items in cart.</td>
        </tr>
    <?php endif; ?>
</tbody>

                </table>
                <form action="" method="post">
                    <input type="hidden" name="action" value="purchase_all">
                    <button type="submit" class="btn btn-success">Purchase All</button>
                </form>
            </div>

            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            <script>
$(document).ready(function() {
    $('#supplier_id').change(function() {
        var supplier_id = $(this).val();
        var supplier_name = $('#supplier_id option:selected').text();
        $('#supplier_name').val(supplier_name);

        if (supplier_id) {
            $.ajax({
                url: 'get_products.php',
                type: 'GET',
                data: { supplier_id: supplier_id },
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        $('#product_id').empty().append('<option value="">Select a product</option>');
                        $.each(response.products, function(index, product) {
                            $('#product_id').append('<option value="' + product.product_id + '" data-name="' + product.product_name + '">' + product.product_name + '</option>');
                        });
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('AJAX error: ' + error);
                }
            });
        } else {
            $('#product_id').empty().append('<option value="">Select a product</option>');
        }
    });

    $('#product_id').change(function() {
        var supplier_id = $('#supplier_id').val();
        var product_id = $(this).val();
        var product_name = $('#product_id option:selected').text();
        $('#product_name').val(product_name);

        if (supplier_id && product_id) {
            $.ajax({
                url: 'get_price_details.php',
                type: 'GET',
                data: { product_id: product_id, supplier_id: supplier_id },
                dataType: 'json',
                success: function(response) {
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
