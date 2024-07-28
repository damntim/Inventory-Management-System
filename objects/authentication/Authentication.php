<?php
class Authentication {
    private $conn;
    private $table_name = "employees";

    public $email;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login() {
        $query = "SELECT employee_id, full_name, gmail, position, image, password FROM " . $this->table_name . " WHERE gmail = ? AND status = 'Active' LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        $num = $stmt->rowCount();

        if ($num > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $employee_id = $row['employee_id'];
            $full_name = $row['full_name'];
            $email = $row['gmail'];
            $position = $row['position'];
            $image = $row['image'];
            $password2 = $row['password'];

            if (($this->password == $password2)) {
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['employee_id'] = $employee_id;
                $_SESSION['full_name'] = $full_name;
                $_SESSION['email'] = $email;
                $_SESSION['position'] = $position;
                $_SESSION['image'] = $image;
                return true;
            }
        }
        return false;
    }
}



function checkAuthorization() {
    session_start();
    // Check if all necessary session variables are set
    if (!isset($_SESSION['employee_id'], $_SESSION['full_name'], $_SESSION['email'], $_SESSION['position'], $_SESSION['image'])) {
        // If not, redirect to the login page
        header("Location: login.php");
        exit();
    }
}


?>
