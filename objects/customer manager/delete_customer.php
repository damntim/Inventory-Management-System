<?php
require_once 'Database.php';

if (isset($_GET['id'])) {
    $database = new Database();
    $db = $database->getConnection();

    $customer_id = $_GET['id'];

    try {
        // Get the photo filename before deleting the customer record
        $query = "SELECT photo FROM customers WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $customer_id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $photo = $row['photo'];
            
            // Delete customer record
            $query = "DELETE FROM customers WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $customer_id);

            if ($stmt->execute()) {
                // Delete the photo file if it exists
                if ($photo && file_exists("uploads/" . $photo)) {
                    unlink("uploads/" . $photo);
                }
                echo "<script>alert('Customer deleted successfully');</script>";
                echo "<script>window.location.href='view_customers.php';</script>"; // Redirect to the customer list page
            } else {
                echo "<script>alert('Failed to delete customer');</script>";
            }
        } else {
            echo "<script>alert('Customer not found');</script>";
        }
    } catch (PDOException $exception) {
        echo "Error: " . $exception->getMessage();
    }
} else {
    echo "<script>alert('Invalid request');</script>";
}
?>

 
