<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prices CRUD</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
        }
        h1 {
            margin-top: 0;
            color: #333;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .action-links a {
            margin-right: 5px;
            color: #007bff;
            text-decoration: none;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Prices CRUD Application</h1>
        <a href="create.php">Create New Price</a>
        <a href="read.php">View Prices</a>
        <?php
            include '../../config/Database.php';

            $database = new Database();
            $db = $database->getConnection();

            $query = "SELECT * FROM prices";
            $stmt = $db->prepare($query);
            $stmt->execute();

            echo "<table>";
            echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Product ID</th>";
            echo "<th>Amount</th>";
            echo "<th>Prices Type</th>";
            echo "<th>Partner ID</th>";
            echo "<th>Net Price</th>";
            echo "<th>Actions</th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);

                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$productID}</td>";
                echo "<td>{$amount}</td>";
                echo "<td>{$pricestype}</td>";
                echo "<td>{$partnerID}</td>";
                echo "<td>{$netprice}</td>";
                echo "<td class='action-links'>";
                echo "<a href='update.php?id={$id}'>Edit</a>";
                echo "<a href='delete.php?id={$id}'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
        ?>
    </div>
</body>
</html>
