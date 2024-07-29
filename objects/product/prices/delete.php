<?php
include '../../config/Database.php';

if ($_GET) {
    $database = new Database();
    $db = $database->getConnection();

    $query = "DELETE FROM prices WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $_GET['id']);

    if ($stmt->execute()) {
        echo "Record was deleted.";
    } else {
        echo "Unable to delete record.";
    }
}
?>

<a href="read.php">Back to list</a>
