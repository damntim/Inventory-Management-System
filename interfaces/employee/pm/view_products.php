<?php
include ("../includes/header.php");
require_once '../../../objects/product/product/Product.php';
require_once '../../../objects/product/category/veiw_category.php';
require_once '../../../objects/employee/stock/veiw_stock.php';

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);
$category = new Category($db);
$stock = new Stock($db);

// Retrieve all products, categories, and stocks
$products = $product->getProducts();
$categories = $category->getAllCategories();
$Stocks = $stock->read();

// Create associative arrays for categories and warehouses
$categoryNames = [];
foreach ($categories as $row) {
    $categoryNames[$row['id']] = $row['categoryName'];
}

$warehouseNames = [];
foreach ($Stocks as $row) {
    $warehouseNames[$row['id']] = $row['category'] . ' - ' . $row['location'];
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
                <h5 class="mt-5 mb-1"><b>Product List</b></h5>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Warehouse</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['product_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                <td><?php echo htmlspecialchars($row['description']); ?></td>
                                <td><?php echo htmlspecialchars($warehouseNames[$row['warehouse_id']]); ?></td>
                                <td><?php echo htmlspecialchars($categoryNames[$row['category_id']]); ?></td>
                                <td><img src="../../../images/products/<?php echo htmlspecialchars($row['product_image']); ?>" width="50"></td>
                                <td>
                                    <a href="edit_product.php?id=<?php echo htmlspecialchars($row['product_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="delete_product.php?id=<?php echo htmlspecialchars($row['product_id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        </main>
    </div>
</div>

<?php include("includes/footer.php") ?>
