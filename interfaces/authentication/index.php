<?php
session_start();
include "header.php";
?>
 <?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Include necessary files
    include_once '../../config/database.php';
    include_once '../../objects/authentication/Authentication.php';

    // Initialize variables
    $error_message = "";

    // Check for empty fields
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error_message = "<div class='alert alert-danger mt-3'>All fields are required.</div>";
    } elseif (strlen($_POST['password']) < 8) {
        // Check if password is at least 8 characters long
        $error_message = "<div class='alert alert-danger mt-3'>Password must be at least 8 characters long.</div>";
    } else {
        // Proceed with the authentication
        $database = new Database();
        $db = $database->getConnection();

        $auth = new Authentication($db);
        $auth->email = $_POST['email'];
        $auth->password = $_POST['password'];

        if ($auth->login()) {
            $position = $_SESSION['position'];
            if ($position == 'Human Resource') {
                header("Location: ../employee/hr/index.php");
            } elseif ($position == 'Product Manager') {
                header("Location: ../employee/pm/index.php");
            } elseif ($position == 'Stock Manager') {
                header("Location: ../employee/sm/index.php");
            } elseif ($position == 'Werahouse Manager') {
                header("Location: ../employee/wm/index.php");
            } elseif ($position == 'Customer Manager') {
                header("Location: ../employee/cm/index.php");
            } else {
                echo "Invalid position.";
            }
            exit;
        } else {
            $error_message = "<div class='alert alert-danger mt-3'>Login failed. Invalid email or password.</div>";
        }
    }

    
}
?>

<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <div class="card login-form">
                <div class="card-body">
                    <h2 class="text-center mb-4">Login to I-M-S</h2>
                    <form class="row p-3" method="POST" action="index.php">
                        <span class="messagern text-danger"></span>
                        <div class="col-lg-12 mt-3">
                            <label>Email address</label>
                            <input type="text" id="email" name="email" placeholder="Email" class="form-control" autocomplete autofocus>
                        </div>
                        <div class="col-lg-12 mt-4">
                            <div class="d-flex flex-row">
                                <label class="flex-grow-1">Password</label>
                                <a href="forgot.php" class="text-danger">Forgot password ?</a>
                            </div>
                            <input type="Password" id="password" name="password" placeholder="Enter Password" class="form-control">
                        </div>
                        <div class="col-lg-12 logined mt-3">
                            <button type="submit" name="login" class="btn btn-primary form-control">Login</button>
                        </div>
                    </form>
                  <?php echo $error_message ?? null ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>
