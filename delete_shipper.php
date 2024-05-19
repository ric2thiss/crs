<?php
include 'functions/delete_shipper.php';

if (isset($_GET['id'])) {
    $ShipperID = $_GET['id'];

    if (delete($ShipperID)) {
        echo "
        <script>
            alert('Shipper deleted successfully.')
            window.location = 'shippers.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Shipper.')
            window.location = 'shippers.php'
        </script>
        ";
    }
} else {
    echo "ShipperID not provided.";
}
?>
