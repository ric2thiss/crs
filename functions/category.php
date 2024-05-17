<?php

function fetch_category_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from categories');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_category(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM categories');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>