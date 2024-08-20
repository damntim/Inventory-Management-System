<?php
include ("../includes/header.php");
require_once '../../../config/database.php';
include ("../../../objects/partner/supplier/Supplier.php"); // Assuming Supplier class file path is correct

// Instantiate database and supplier object
$database = new Database();
$db = $database->getConnection();
$supplier = new Supplier($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $tin = $_POST['tin'];
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Set supplier properties
    $supplier->tin = $tin;
    $supplier->fullname = $fullName;
    $supplier->email = $email;
    $supplier->address = $address;

    // Add supplier to the database
    if ($supplier->create()) {
        echo '<script>
        alert("supplier added successfully!");
        window.location.href = "../../../interfaces/employee/pm/all_supplier.php";
    </script>';
    } else{
        echo '<script>
        alert("supplier add failed!");
        window.location.href = "../../../interfaces/employee/pm/addsupplier.php";
    </script>';
    }
}
?>

<div class="container-fluid">
    <div class="row">
        <?php include("includes/navbar.php")?>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Add New Supplier</h2>
            </div>
            <form action="" method="post" class="needs-validation form-shadow" novalidate>
              
                <div class="form-group row">
                    <label for="fullname" class="col-sm-2 col-form-label">Full Name:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                        <div class="invalid-feedback">Please enter the supplier's full name.</div>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="tin" class="col-sm-2 col-form-label">TIN:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="tin" name="tin" required>
                        <div class="invalid-feedback">Please enter the supplier's TIN.</div>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" id="email" name="email" required>
                        <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>
                </div><br>
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address:</label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="address" name="address" required>
                        <div class="invalid-feedback">Please enter the supplier's address.</div>
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-8 offset-sm-4">
                        <button type="submit" class="btn btn-primary">Add Supplier</button>
                    </div>
                </div>
            </form>
        </main>
    </div>
</div>

<script>
    (function() {
        'use strict';
        window.addEventListener('load', function() {
            var forms = document.getElementsByClassName('needs-validation');
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<?php include("includes/footer.php") ?>
