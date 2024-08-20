<?php 

include '../../objects/authentication/Authentication.php';
$customer = checkCustomer();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eshop</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="gallery/logo.png">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="font-awesome/css/all.css">
    <link rel="stylesheet" href="css/cart.css">
</head>
<body>
  
  <!------------------------------------------------------Header---------------------------------------------------->
  <nav class="navbar navbar-expand-lg navbar-light bg-white" style="max-height:70px;z-index:10;">
  <a class="navbar-brand" href="#"><span id="bd-title"><img src="gallery/navbrd.png" style="max-height:50px;">Eshop</span></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navdp" aria-controls="navdp" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse bg-white" style="width:100%;" id="navdp">
    <form class="form-inline bg-white my-2 my-lg-0 mrl">
      <!-- All Categories dropdown -->
      <select class="form-control mr-2">
        <option value="0">All Categories</option>
        <option value="1">Category 1</option>
      
      </select>
      <!-- Search input -->
      <input class="form-control mr-sm-2 srh-w bg-white" style="width:400px;" type="search" placeholder="Search..." aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    
    <!-- Profile icon -->
    <div class="ml-auto d-flex align-items-center">
    <?php if (!$customer): ?>
        <!-- Show Sign In button if not logged in -->
        <a href="../authentication/index.php" class="btn btn-outline-primary">Sign In</a> 
    <?php else: ?>

        <!-- Show Profile icon and image if logged in -->
<div class="dropdownn">
    <input type="checkbox" id="dropdown-toggle" class="dropdown-checkbox" hidden>
    <label for="dropdown-toggle" class="dropdown-label">
        <img src="../../images/customers/<?php echo htmlspecialchars($customer['photo']); ?>" alt="<?php echo htmlspecialchars($customer['fullname']); ?>" style="width:30px;height:30px;border-radius:50%;">
    </label>
    <div class="dropdownn-content">
        <a href="#"><i class="fa fa-user-circle" aria-hidden="true"></i> My Profile</a>
        <a href="logout.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Log out</a>
    </div>
</div>

    <?php endif; ?>

  <!-- Cart button -->
  <button type="button" class="btn btn-info ml-2 cart-icon">
          <i class="fas fa-shopping-cart"></i> Cart &nbsp;<span class="badge badge-light cart-badge">0</span>
        </button>

<!-- Cart Modal -->
<div class="cart-modal" style="display: none;">
          <div class="cart-modal-content">
            <span class="cart-close">&times;</span>
            <h2>Your Cart</h2>
            <div class="cart-items"></div>
            <h4 class="total-price">Total: Rwf0.00</h4>
            <button class="btn btn-danger clear-cart">Clear Cart</button>
          </div>
        </div>

</div>

  </div>
</nav>
   
<!------------------------------------------------------Header---------------------------------------------------->

<!------------------------------------------------------Product Cards---------------------------------------------------->
<?php
// include("../includes/header.php");
require_once '../../objects/product/product/Product.php';
require_once '../../config/Database.php';

// Instantiate database and product object
$database = new Database();
$db = $database->getConnection();
$product = new Product($db);

// Fetch available products
$products = $product->readAvailableProducts();
?>
<div class="container-fluid pt-2 pb-3" style="background-color:#F0FFFF; border-bottom:1px solid darkgray; padding-bottom: 0; margin-bottom: 0;">
  <div class="row">
    <div class="col-sm-12">
      <div id="inm" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)): ?>
               
<div class="col">
    <div class="card h-100">
        <img src="../../images/products/<?php echo htmlspecialchars($row['product_image']); ?>" class="card-img-top product-img" alt="Product Image">
        <div class="card-body">
            <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
            <p class="card-text"><?php echo htmlspecialchars($row['description']); ?></p>
            <p class="card-text"><strong>Price:Rwf <?php echo htmlspecialchars($row['selling_price']); ?></strong></p>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary add-to-cart" 
              data-image= <img src="../../images/products/<?php echo htmlspecialchars($row['product_image']); ?>"
              data-id="<?php echo htmlspecialchars($row['id']); ?>" 
              data-name="<?php echo htmlspecialchars($row['product_name']); ?>" 
              data-price="<?php echo htmlspecialchars($row['selling_price']); ?>">
              Add to Cart
            </button>
          </div>
    </div>
</div>

                <?php endwhile; ?>
              </div>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" style="margin-left:20px; width:50px;" href="#inm" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon card-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" style="margin-right:20px; width:50px;" href="#inm" role="button" data-slide="next">
          <span class="carousel-control-next-icon card-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>

      </div>
    </div>
  </div>
</div>

<!------------------------------------------------------Product Cards---------------------------------------------------->
<!------------------------------------------------------Top Sales---------------------------------------------------->
<div class="container-fluid pt-5 pb-3" style="background-color:#F0FFFF; border-top:1px solid darkgray; padding-top: 2rem; margin-bottom: 0;">
  <div class="row">
    <div class="col-sm-12">
      <h2 class="text-center mb-4">Top Sales</h2>
      <div class="row row-cols-1 row-cols-md-4 g-4">
        <!-- Example Product Card 1 -->
        <div class="col">
          <div class="card h-100">
            <img src="path/to/top-sale-product1.jpg" class="card-img-top product-img" alt="Top Sale Product 1">
            <div class="card-body">
              <h5 class="card-title">Product Name 1</h5>
              <p class="card-text">Description of the top sale product 1.</p>
              <p class="card-text"><strong>Price: $XX.XX</strong></p>
            </div>
            <div class="card-footer">
              <button type="button" class="btn btn-primary btn-sm">Add to Cart</button>
            </div>
          </div>
        </div>
        <!-- Add more product cards here if needed -->
      </div>
    </div>
  </div>
</div>
<!------------------------------------------------------Top Sales---------------------------------------------------->

<!------------------------------------------------------Footer---------------------------------------------------->
<footer class="footdes">
    <div class="container-fluid footer-1">
        <div class="row">
            <div class="col-sm foocol-2 text-center">
                <div class="footer-2-div">
                    <a href="https://www.facebook.com"><i class="fab fa-facebook text-white"></i></a>
                    <a href="https://www.twitter.com"><i class="fab fa-twitter text-white"></i></a>
                    <a href="https://www.linkedin.com"><i class="fab fa-linkedin-in text-white"></i></a>
                    <a href="https://www.instagram.com"><i class="fab fa-instagram text-white"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!------------------------------------------------------Footer---------------------------------------------------->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="cart.js"></script>


    




<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileToggle = document.getElementById('profile-toggle');
        const profileDropdown = document.getElementById('profile-dropdown');
        const dropdownContent = profileDropdown.querySelector('.dropdownn-content');

        profileToggle.addEventListener('click', function(event) {
            event.preventDefault();
            dropdownContent.style.display = (dropdownContent.style.display === 'block') ? 'none' : 'block';
        });

        // Optional: Hide dropdown if clicked outside
        document.addEventListener('click', function(event) {
            if (!profileDropdown.contains(event.target) && dropdownContent.style.display === 'block') {
                dropdownContent.style.display = 'none';
            }
        });
    });
</script>



</body>
</html>

