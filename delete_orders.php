<?php
include 'functions/delete_orders.php';

if (isset($_GET['id'])) {
    $OrderID = $_GET['id'];

    if (delete($OrderID)) {
        echo "
        <script>
            alert('Order deleted successfully.')
            window.location = 'orders.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Order.')
            window.location = 'orders.php'
        </script>
        ";
    }
} else {
    echo "OrderID not provided.";
}
?>
