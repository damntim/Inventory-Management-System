<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory System Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="public/css/mindashboard.css">
</head>

<body>
    <header>
        <div class="navbar">
            <div class="logo">
                <h1>LOGO</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Category</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>
            <div class="search-container">
                <input type="text" placeholder="Search Product..." class="search-input">
                <button class="search-button">Search</button>
            </div>

            <div class="login">
                <a href="interfaces/authentication/index.php" class="login-button">Sign in</a>
                <a href="interfaces/customer/signup.php" class="signup-button">Sign up</a>
            </div>
        </div>
    </header>

    <main>
        <div class="products">
            <h2>Our All Products</h2>
            <div class="product-list">
                <?php
                include_once 'config.php';

                try {
                    // Instantiate database and get connection
                    $database = new Database();
                    $db = $database->getConnection();

                    // Fetch products with selling price > 0
                    $products_sql = "SELECT p.*, c.categoryName FROM products p
                                     LEFT JOIN categories c ON p.productCategory = c.id
                                     WHERE p.sellingPrice > 0";
                    $products_result = $db->query($products_sql);

                    if ($products_result->rowCount() > 0) {
                        while ($row = $products_result->fetch(PDO::FETCH_ASSOC)) {
                            echo '<div class="product-item">';
                            echo '<img src="images/products' . htmlspecialchars($row['productImage']) . '" alt="' . htmlspecialchars($row['productName']) . '" style="width:40%;height:40%;">';
                            echo '<h3>' . htmlspecialchars($row['productName']) . '</h3>';
                            echo '<h5>Category: ' . htmlspecialchars($row['categoryName']) . '</h5>';
                            echo '<p>$' . htmlspecialchars($row['sellingPrice']) . '</p>';
                            echo '<button class="btn">Add to Cart</button>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No products available.</p>';
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Ishyiga Bootcamp. All rights reserved.</p>
    </footer>
</body>

</html>
