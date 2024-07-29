<?php
require_once 'Database.php';

$database = new Database();
$db = $database->getConnection();

try {
    $query = "SELECT * FROM customers";
    $stmt = $db->prepare($query);
    $stmt->execute();

    echo "<table border='1'>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Username</th>
                <th>Photo</th>
                <th>Action</th>
            </tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['fullname']}</td>
                <td>{$row['contact']}</td>
                <td>{$row['email']}</td>
                <td>{$row['address']}</td>
                <td>{$row['username']}</td>
                <td><img src='uploads/{$row['photo']}' width='50' height='50'></td>
                <td><a href='delete_customer.php?id={$row['id']}'>Delete</a></td>
              </tr>";
    }

    echo "</table>";
} catch (PDOException $exception) {
    echo "Error: " . $exception->getMessage();
}
?>
