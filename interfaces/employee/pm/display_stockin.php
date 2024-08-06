<?php
require_once '../../../config/Database.php';
require_once '../../../objects/product/stockin/Stockin.php';

$database = new Database();
$db = $database->getConnection();
$stockin = new Stockin($db);

// Handle download request
if (isset($_GET['action']) && $_GET['action'] == 'download') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="stockin_data.csv"');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('Stock ID', 'Product Name', 'Supplier Fullname', 'Supplier Email', 'Amount', 'Tax Rate', 'Discount', 'Net Price', 'Quantity', 'Total Price', 'Date And Time'));
    
    // Fetch the data and write to CSV in the desired order
    $stmt = $stockin->readAll();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $data = array(
            $row['stock_id'],
            $row['product_name'],
            $row['fullname'],
            $row['email'],
            $row['amount'],
            $row['taxrate'],
            $row['discount'],
            $row['netprice'],
            $row['quantity'],
            $row['totalprice'],
            $row['created_at']
        );
        fputcsv($output, $data);
    }
    fclose($output);
    exit;
}
include("../includes/header.php");

if (isset($_GET['delete_id'])) {
    $stockin->stock_id = $_GET['delete_id'];
    if ($stockin->delete()) {
        echo "<div class='alert alert-success'>Record deleted successfully.</div>";
    } else {
        echo "<div class='alert alert-danger'>Unable to delete record. Please try again.</div>";
    }
}

$records = $stockin->readAll();
?>

<div class="container-fluid">
    <div class="row">
        <?php include("includes/navbar.php") ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Stock In Records</h1>
                <div>
                    <a href="?action=download" class="btn btn-primary">Download CSV</a>
                </div>
            </div>
            <div class="container">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                        <th>Stock ID</th>
                            <th>Product Name</th>
                           
                            <th>Supplier Fullname</th>
                            <th>Supplier Email</th>
                            <th>Amount</th>
                           
                            <th>Tax Rate</th>
                            <th>Discount</th>
                            <th>Net Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th>DateAndTime</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $records->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                            <td><?php echo htmlspecialchars($row['stock_id']); ?></td>
                                <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                              
                                <td><?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['amount']); ?></td>
                                
                                <td><?php echo htmlspecialchars($row['taxrate']); ?></td>
                                <td><?php echo htmlspecialchars($row['discount']); ?></td>
                                <td><?php echo htmlspecialchars($row['netprice']); ?></td>
                                <td><?php echo htmlspecialchars($row['quantity']); ?></td>
                                <td><?php echo htmlspecialchars($row['totalprice']); ?></td>
                                <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                                <td>
                                    <a href="?delete_id=<?php echo $row['stock_id']; ?>" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<?php include("includes/footer.php") ?>
