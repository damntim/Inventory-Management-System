<?php
<<<<<<< HEAD
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
=======
include_once 'config.php';

// Define the number of results per page
$results_per_page = 10;

// Determine the current page number
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $results_per_page;

// Determine the selected entity type
$entityType = isset($_GET['entityType']) ? $_GET['entityType'] : '';

// Initialize the WHERE clause
$whereClause = '';

// Set the SQL query based on the selected entity type
if ($entityType == 'category') {
    $whereClause = 'WHERE c.categoryName IS NOT NULL';
} elseif ($entityType == 'stock') {
    $whereClause = 'WHERE s.location IS NOT NULL';
}

try {
    // Instantiate database and get connection
    $database = new Database();
    $db = $database->getConnection();

    // Fetch the total number of products
    $total_products_sql = "SELECT COUNT(*) FROM products p
                           LEFT JOIN categories c ON p.productCategory = c.id
                           LEFT JOIN stocks s ON p.stock = s.id
                           $whereClause";
    $total_products_result = $db->query($total_products_sql);
    $total_products_row = $total_products_result->fetch(PDO::FETCH_NUM);
    $total_products = $total_products_row[0];
    $total_pages = ceil($total_products / $results_per_page);

    // Fetch products for the current page
    $products_sql = "SELECT p.*, c.categoryName, s.location FROM products p
                     LEFT JOIN categories c ON p.productCategory = c.id
                     LEFT JOIN stocks s ON p.stock = s.id
                     $whereClause
                     LIMIT $start_from, $results_per_page";
    $products_result = $db->query($products_sql);

    // Calculate the number of products on the current page
    $current_page_products = $products_result->rowCount();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

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
            <a href="editprofile.php">Edit Profile</a>
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
    <h5 class="mb-1"><b>View Products</b></h5>



    <div class="row" style="margin-left:70%;margin-top:-3.3%;box-shadow;">
        <div class="col-sm-8 offset-sm-4">
            <a href="addproduct.php" class="btn btn-secondary">Add New Product</a>
        </div>
    </div>

    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Supply Price</th>
                <th>Selling Price</th>
                <th>Product Category</th>
                <th>Quantity</th>
                <th>Stock</th>
                <th>Product Description</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th style="width:30px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($products_result->rowCount() > 0): ?>
                <?php while ($row = $products_result->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['productName']); ?></td>
                        <td><?php echo htmlspecialchars($row['supplyPrice']); ?></td>
                        <td><?php echo htmlspecialchars($row['sellingPrice']); ?></td>
                        <td><?php echo htmlspecialchars($row['categoryName']); ?></td>
                        <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                        <td><?php echo htmlspecialchars($row['location']); ?></td>
                        <td><?php echo htmlspecialchars($row['productDescription']); ?></td>
                        <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        <td><?php echo htmlspecialchars($row['updated_at']); ?></td>
                        <td>
                            <a href="editproduct.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-primary btn-sm">Edit</a><br>
                            <a href="deleteproduct.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No products found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Display entity counts -->
    <div class="mb-3">
     
        <p>Products on Current Page: <?php echo htmlspecialchars($current_page_products)?> of Total Products: <?php echo htmlspecialchars($total_products); ?></p>
    </div>
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="view_products.php?page=<?php echo $page-1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo; Previous</span>
                    </a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="view_products.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="view_products.php?page=<?php echo $page+1; ?>" aria-label="Next">
                        <span aria-hidden="true">Next &raquo;</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>


        
      </div>
    </main>
  </div>
>>>>>>> 73b688557fa0006d2b819a26541ef1c190876430
</div>

<?php include("includes/footer.php") ?>
</body>
</html>
