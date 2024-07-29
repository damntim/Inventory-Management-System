<?php
include '../../config/Database.php';

// Initialize variables to avoid "undefined variable" warnings
$productID = '';
$amount = '';
$pricestype = '';
$partnerID = '';
$netprice = '';

if ($_POST) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "UPDATE prices SET productID = :productID, amount = :amount, pricestype = :pricestype, partnerID = :partnerID, netprice = :netprice WHERE id = :id";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':productID', $_POST['productID']);
    $stmt->bindParam(':amount', $_POST['amount']);
    $stmt->bindParam(':pricestype', $_POST['pricestype']);
    $stmt->bindParam(':partnerID', $_POST['partnerID']);
    $stmt->bindParam(':netprice', $_POST['netprice']);
    $stmt->bindParam(':id', $_POST['id']);

    if ($stmt->execute()) {
        header("Location: read.php"); // Redirect to display.php after update
        exit();
    } else {
        echo "Unable to update record.";
    }
}

if ($_GET) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "SELECT * FROM prices WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $productID = $row['productID'];
        $amount = $row['amount'];
        $pricestype = $row['pricestype'];
        $partnerID = $row['partnerID'];
        $netprice = $row['netprice'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Price</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 0 auto;
        }
        .form-container h2 {
            margin-top: 0;
        }
        .form-container input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-container input[type="submit"] {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-container input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Update Price</h2>
        <form action="update.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET['id']); ?>">
            Product ID: <input type="text" name="productID" value="<?php echo htmlspecialchars($productID); ?>"><br>
            Amount: <input type="text" name="amount" value="<?php echo htmlspecialchars($amount); ?>"><br>
            Prices Type: <input type="text" name="pricestype" value="<?php echo htmlspecialchars($pricestype); ?>"><br>
            Partner ID: <input type="text" name="partnerID" value="<?php echo htmlspecialchars($partnerID); ?>"><br>
            Net Price: <input type="text" name="netprice" value="<?php echo htmlspecialchars($netprice); ?>"><br>
            <input type="submit" value="Update">
        </form>
    </div>
</body>
</html>
