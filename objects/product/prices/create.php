
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
