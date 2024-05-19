<?php

    include 'db.php';
    function delete($id) {
        $conn = db_conn();

        try {
            // Use prepared statement to prevent SQL injection for the ID
            $stmt = $conn->prepare("DELETE FROM shippers WHERE ShipperID= ?");
            $stmt->execute([$id]);
    
            if ($stmt->rowCount() > 0) {
                return true; 
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Handle the exception as needed
            return false;
        }
    }

?>