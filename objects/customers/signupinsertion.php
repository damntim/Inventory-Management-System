<?php
 include_once '../../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $db = $database->getConnection();

    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $photo = $_FILES['photo']['name'];

    // File upload path
    $targetDir = "'../../../images/customers/'";
    $targetFilePath = $targetDir . basename($photo);
    move_uploaded_file($_FILES['photo']['tmp_name'], $targetFilePath);

    try {
        $query = "INSERT INTO customers (fullname, contact, email, address, username, password, photo) 
                  VALUES (:fullname, :contact, :email, :address, :username, :password, :photo)";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':fullname', $fullname);
        $stmt->bindParam(':contact', $contact);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':photo', $photo);

        if($stmt->execute()) {
            echo "<script>alert('Data inserted successfully');</script>";
             header("Location: ../../interfaces/authentication/index.php");
        } else {
            echo "<script>alert('Data insertion failed');</script>";
        }
    } catch(PDOException $exception) {
        echo "Error: " . $exception->getMessage();
    }
}
?>
