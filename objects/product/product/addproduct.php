\<?php

include_once 'config.php';

class Product {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Method to add a new product
    public function addProduct($productName, $productImage, $supplyPrice, $productCategory, $quantity, $stock, $productDescription) {
        try {
            $stmt = $this->db->prepare("INSERT INTO products (productName, productImage, supplyPrice, sellingPrice, productCategory, quantity, stock, productDescription) VALUES (:productName, :productImage, :supplyPrice, 0, :productCategory, :quantity, :stock, :productDescription)");
            $stmt->bindParam(':productName', $productName);
            $stmt->bindParam(':productImage', $productImage);
            $stmt->bindParam(':supplyPrice', $supplyPrice);
            $stmt->bindParam(':productCategory', $productCategory);
            $stmt->bindParam(':quantity', $quantity);
            $stmt->bindParam(':stock', $stock);
            $stmt->bindParam(':productDescription', $productDescription);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
            return false;
        }
    }

    // Method to handle file upload for product image
    public function uploadProductImage($file) {
        $targetDir = "../../../images/products/";
        $targetFile = $targetDir . basename($file['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $error = "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            $error = "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 500000) {
            $error = "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }


        if ($uploadOk == 0) {
            $error = "Sorry, your file was not uploaded.<br>";
            return false;
     
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $error = "The file ". basename($file["name"]). " has been uploaded.<br>";
                return $targetFile;
            } else {
                $error = "Sorry, there was an error uploading your file.<br>";
                return false;
            }
        }
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST['productName'];
    $supplyPrice = $_POST['supplyPrice'];
    $productCategory = $_POST['productCategory'];
    $quantity = $_POST['quantity'];
    $stock = $_POST['stock'];
    $productDescription = $_POST['productDescription'];

    // Initialize Product class with database connection
    $product = new Product($conn);

    // Handle file upload for product image
    if (isset($_FILES['productImage'])) {
        $productImage = $product->uploadProductImage($_FILES['productImage']);

        // Check if image upload was successful
        if ($productImage) {
            // Add product to database
            if ($product->addProduct($productName, $productImage, $supplyPrice, $productCategory, $quantity, $stock, $productDescription)) {
                // Redirect to success page or show success message
                echo '<script>
                    alert("Product added successfully!");
                    window.location.href = "../../../interfaces/employee/pm/view_products.php";
                </script>';
            } else {
                echo '<script>
                    alert("Failed to add product. Please try again.");
                    window.location.href = "../../../interfaces/employee/pm/addproduct.php";
                </script>';
            }
        } else {
            echo '<script>
                alert("Failed to upload product image. Please try again.");
                window.location.href = "../../../interfaces/employee/pm/addproduct.php";
            </script>';
        }
    } else {
        echo '<script>
            alert("No product image uploaded. Please try again.");
            window.location.href = "../../../interfaces/employee/pm/addproduct.php";
        </script>';
    }
}
?>
