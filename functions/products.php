<?php

function fetch_products_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from products');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }
?>