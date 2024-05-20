<?php
include 'functions/delete_order_detail.php';

if (isset($_GET['id'])) {
    $OrderDetailID = $_GET['id'];

    if (delete($OrderDetailID)) {
        echo "
        <script>
            alert('Order Detail deleted successfully.')
            window.location = 'order_details.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Order Detail.')
            window.location = 'order_details.php'
        </script>
        ";
    }
} else {
    echo "OrderDetailID not provided.";
}
?>
