<?php 
include '../../../objects/authentication/Authenticationd.php';
checkAuthorization();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory system management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="../../public/css/mindashboard.cssi">
    <link rel="stylesheet" href="../../public/css/mindashboard.cssi">
    

    <style>
        
        

        .product-container {
            display: flex;
            gap: 20px; /* Add some space between the cards */
            justify-content: center; /* Center the cards horizontally */
        }

        .product-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-10px);
        }

        .product-image {
            width: 100%;
            height: 200px; /* Set a fixed height for the images */
            object-fit: cover; /* Ensure the image covers the entire area while maintaining aspect ratio */
        }

        .product-info {
            padding: 15px;
            text-align: center;
            flex-grow: 1; /* Make the product info take up the remaining space */
        }

        .product-title {
            font-size: 1.5em;
            margin: 10px 0;
        }


        .product-description {
            font-size: 1em;
            color: #666;
            margin: 10px 0;
        }

        .product-price {
            font-size: 1.2em;
            color: #333;
            margin: 10px 0;
        }

        .add-to-cart {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            font-size: 1em;
            color: #fff;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .add-to-cart:hover {
            background-color: #218838;
        }
    </style>

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
    <div class="product-container" style="margin-top:-120">
    <div class="product-card">
        <img src="../../images/customers/desktop.png" alt="Product Image" class="product-image">
        <div class="product-info">
            <h2 class="product-title">Product Title</h2>
            <p class="product-description">This is a brief description of the product, highlighting its main features and benefits.</p>
            <p class="product-price">$49.99</p>
            <a href="#" class="add-to-cart">Add to Cart</a>
        </div>
    </div>
    <div class="product-card">
        <img src="../../images/customers/flatiron.png" alt="Product Image" class="product-image">
        <div class="product-info">
            <h2 class="product-title">Product Title</h2>
            <p class="product-description">This is a brief description of the product, highlighting its main features and benefits.</p>
            <p class="product-price">$49.99</p>
            <a href="#" class="add-to-cart">Add to Cart</a>
        </div>
    </div>
    <div class="product-card">
        <img src="../../images/customers/richasking.png" alt="Product Image" class="product-image">
        <div class="product-info">
            <h2 class="product-title">Product Title</h2>
            <p class="product-description">This is a brief description of the product, highlighting its main features and benefits.</p>
            <p class="product-price">$49.99</p>
            <a href="#" class="add-to-cart">Add to Cart</a>
        </div>
    </div>
</div>
</main>
    <footer>
        <p>&copy; 2024 Ishyiga Bootcamp. All rights reserved.</p>
    </footer>
</body>

</html>
