<?php
include 'functions/delete_product.php';

if (isset($_GET['id'])) {
    $ProductID = $_GET['id'];

    if (delete($ProductID)) {
        echo "
        <script>
            alert('Product deleted successfully.')
            window.location = 'products.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Product.')
            window.location = 'products.php'
        </script>
        ";
    }
} else {
    echo "ProductID not provided.";
}
?>
