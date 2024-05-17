<?php

function fetch_employees_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from employee');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_employees(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM employee');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>