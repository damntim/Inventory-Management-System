<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Price</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input[type="text"], input[type="number"] {
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        input[type="submit"], .cancel-btn {
            padding: 10px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .cancel-btn {
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            display: inline-block;
        }
        .cancel-btn:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create New Price</h1>
        <?php
        include '../../config/Database.php';

        if ($_POST) {
            $database = new Database();
            $db = $database->getConnection();

            if ($db) {
                $query = "INSERT INTO prices (productID, amount, pricestype, partnerID, netprice) VALUES (:productID, :amount, :pricestype, :partnerID, :netprice)";
                $stmt = $db->prepare($query);

                $stmt->bindParam(':productID', $_POST['productID']);
                $stmt->bindParam(':amount', $_POST['amount']);
                $stmt->bindParam(':pricestype', $_POST['pricestype']);
                $stmt->bindParam(':partnerID', $_POST['partnerID']);
                $stmt->bindParam(':netprice', $_POST['netprice']);

                if ($stmt->execute()) {
                    echo "Record was created.";
                    header("Location: read.php");
                    exit();
                } else {
                    echo "Unable to create record.";
                }
            } else {
                echo "Failed to establish a database connection.";
            }
        }
        ?>

        <form action="create.php" method="post">
            Product ID: <input type="text" name="productID" required><br>
            Amount: <input type="number" step="0.01" name="amount" required><br>
            Prices Type: <input type="text" name="pricestype" required><br>
            Partner ID: <input type="text" name="partnerID" required><br>
            Net Price: <input type="number" step="0.01" name="netprice" required><br>
            <input type="submit" value="Save">
            <a href="read.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
</body>
</html>
