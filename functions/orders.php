<?php
    // include 'db.php';


    function fetch_orders(){
        $conn = db_conn();
        $stmt = $conn->query('SELECT * FROM orders');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_order_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from orders');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }
?>