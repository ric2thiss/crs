<?php

function fetch_order_datails_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from orderdetails');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_order_details(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM orderdetails');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function save_order_details($OrderID, $ProductID, $Quantity) {
    $conn = db_conn();
    try {
        // Prepare SQL statement
        $stmt = $conn->prepare('INSERT INTO orderdetails (OrderID, ProductID, Quantity) 
                                VALUES (:OrderID, :ProductID, :Quantity)');
        
        // Bind parameters
        $stmt->bindParam(':OrderID', $OrderID);
        $stmt->bindParam(':ProductID', $ProductID);
        $stmt->bindParam(':Quantity', $Quantity);
        
        // Execute the statement
        $stmt->execute();
        
        // If the execution is successful, return true
        return true;
    } catch (PDOException $e) {
        // Display error message
        echo "Error: " . $e->getMessage();
        return false;
    }
}


?>