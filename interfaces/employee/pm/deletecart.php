<?php
session_start();

// Check if the key for the item to be removed is set
if (isset($_POST['item_key'])) {
    $item_key = $_POST['item_key'];

    // Remove the item from the session cart
    if (isset($_SESSION['cart'][$item_key])) {
        unset($_SESSION['cart'][$item_key]);

        // Re-index the cart to avoid gaps in array keys
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        echo "<script>
                alert('Item removed from cart.');
                window.location.href = 'add_stockin.php'; 
              </script>";
    } else {
        echo "<script>
                alert('Item not found.');
                window.location.href = 'add_stockin.php'; 
              </script>";
    }
} else {
    echo "<script>
            alert('No item to remove.');
            window.location.href = 'add_stockin.php';
          </script>";
}
?>
