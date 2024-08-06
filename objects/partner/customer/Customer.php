<?php
class Customer {
    private $conn;
    private $table_name = "customers";

    public $id;
    public $fullname;
    public $contact;
    public $email;
    public $address;
    public $username;
    public $password;
    public $photo;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getCustomers() {
        $query = "SELECT id, fullname FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function addCustomer() {
        $query = "INSERT INTO " . $this->table_name . " (fullname, contact, email, address, username, password, photo) VALUES (:fullname, :contact, :email, :address, :username, :password, :photo)";
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->fullname = htmlspecialchars(strip_tags($this->fullname));
        $this->contact = htmlspecialchars(strip_tags($this->contact));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->photo = htmlspecialchars(strip_tags($this->photo));

        // bind values
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":contact", $this->contact);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":address", $this->address);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":photo", $this->photo);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
