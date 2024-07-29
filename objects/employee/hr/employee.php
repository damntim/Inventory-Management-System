<?php
class Employee {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Create a new employee
    public function create($employee_id, $full_name, $gmail, $phone, $dob, $gender, $resident_gps, $image, $position, $hired_date, $contract_type, $contract_length, $bank_name, $bank_account_number, $status, $password) {
        $sql = "INSERT INTO employees (employee_id, full_name, gmail, phone, dob, gender, resident_gps, image, position, hired_date, contract_type, contract_length, bank_name, bank_account_number, status, password) 
                VALUES (:employee_id, :full_name, :gmail, :phone, :dob, :gender, :resident_gps, :image, :position, :hired_date, :contract_type, :contract_length, :bank_name, :bank_account_number, :status, :password)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':employee_id' => $employee_id,
            ':full_name' => $full_name,
            ':gmail' => $gmail,
            ':phone' => $phone,
            ':dob' => $dob,
            ':gender' => $gender,
            ':resident_gps' => $resident_gps,
            ':image' => $image,
            ':position' => $position,
            ':hired_date' => $hired_date,
            ':contract_type' => $contract_type,
            ':contract_length' => $contract_length,
            ':bank_name' => $bank_name,
            ':bank_account_number' => $bank_account_number,
            ':status' => $status,
            ':password' => $password
        ]);
    }

    // Read employee data by ID
    public function read($employee_id) {
        $sql = "SELECT * FROM employees WHERE employee_id = :employee_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':employee_id' => $employee_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update employee data
    public function update($employee_id, $full_name, $gmail, $phone, $dob, $gender, $resident_gps, $image, $position, $hired_date, $contract_type, $contract_length, $bank_name, $bank_account_number, $status, $password) {
        $sql = "UPDATE employees SET full_name = :full_name, gmail = :gmail, phone = :phone, dob = :dob, gender = :gender, resident_gps = :resident_gps, image = :image, position = :position, hired_date = :hired_date, contract_type = :contract_type, contract_length = :contract_length, bank_name = :bank_name, bank_account_number = :bank_account_number, status = :status, password = :password WHERE employee_id = :employee_id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':employee_id' => $employee_id,
            ':full_name' => $full_name,
            ':gmail' => $gmail,
            ':phone' => $phone,
            ':dob' => $dob,
            ':gender' => $gender,
            ':resident_gps' => $resident_gps,
            ':image' => $image,
            ':position' => $position,
            ':hired_date' => $hired_date,
            ':contract_type' => $contract_type,
            ':contract_length' => $contract_length,
            ':bank_name' => $bank_name,
            ':bank_account_number' => $bank_account_number,
            ':status' => $status,
            ':password' => $password
        ]);
    }

    // Delete employee data
    public function delete($employee_id) {
        $sql = "DELETE FROM employees WHERE employee_id = :employee_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':employee_id' => $employee_id]);
    }
    public function listAllExceptLoggedIn($logged_in_employee_id) {
        $sql = "SELECT * FROM employees WHERE employee_id != :employee_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':employee_id' => $logged_in_employee_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   
}
?>
