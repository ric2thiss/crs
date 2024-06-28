<?php
    // include 'db.php';


    function fetch_orders(){
        $conn = db_conn();
        $stmt = $conn->query('SELECT * FROM orders order by OrderID DESC');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_order_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from orders');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }

    function save_order_to_database($customerID, $employeeID, $shipperID, $orderDate) {
        $conn = db_conn();
    
        try {
            // Prepare SQL statement to insert order
            $stmt = $conn->prepare('INSERT INTO orders (CustomerID, EmployeeID, ShipperID, OrderDate) VALUES (:CustomerID, :EmployeeID, :ShipperID, :OrderDate)');
    
            // Bind parameters
            $stmt->bindParam(':CustomerID', $customerID);
            $stmt->bindParam(':EmployeeID', $employeeID);
            $stmt->bindParam(':ShipperID', $shipperID);
            $stmt->bindParam(':OrderDate', $orderDate);
    
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