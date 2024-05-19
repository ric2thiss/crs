<?php
include 'functions/delete_category.php';

if (isset($_GET['id'])) {
    $categoryID = $_GET['id'];

    if (delete($categoryID)) {
        echo "
        <script>
            alert('Category deleted successfully.')
            window.location = 'category.php'
        </script>

        ";
    } else {
        echo "
        <script>
            alert('Failed to delete Category. Try again!')
            window.location = 'category.php'
        </script>
        ";
    }
} else {
    echo "CategoryID not provided.";
}
?>
