<?php
include 'functions/delete.php';

// echo $_GET['id'];
// Check if CustomerID is set in the query string
if (isset($_GET['id'])) {
    $customerID = $_GET['id'];
    // $table = 'customer';
    // $column = 'CustomerID';

    if (delete($customerID)) {
        echo "
        <script>
            alert('Customer deleted successfully.')
            window.location = 'customers.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete customer. Try again!')
            window.location = 'customers.php'
        </script>
        ";
    }
} else {
    echo "CustomerID not provided.";
}
?>
