<?php
include 'functions/delete_supplier.php';

if (isset($_GET['id'])) {
    $SupplierID = $_GET['id'];

    if (delete($SupplierID)) {
        echo "
        <script>
            alert('Supplier deleted successfully.')
            window.location = 'suppliers.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Supplier.')
            window.location = 'suppliers.php'
        </script>
        ";
    }
} else {
    echo "SupplierID not provided.";
}
?>
