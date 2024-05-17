<?php

function fetch_suppliers_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from suppliers');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_suppliers(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM suppliers');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>