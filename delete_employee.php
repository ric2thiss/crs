<?php
include 'functions/delete_employee.php';

if (isset($_GET['id'])) {
    $EmployeeID = $_GET['id'];

    if (delete($EmployeeID)) {
        echo "
        <script>
            alert('Employee deleted successfully.');
            window.location = 'employees.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Employee. Try again!');
            window.location = 'employees.php';
        </script>
        ";
    }
} else {
    echo "EmployeeID not provided.";
}
?>
