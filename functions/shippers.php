<?php

function fetch_shippers_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from shippers');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_shippers(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM shippers');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function insert_shipper_to_database($shipperName, $phone) {
    $conn = db_conn();
    $stmt = $conn->prepare("INSERT INTO shippers (ShipperName, Phone) VALUES (?, ?)");
    return $stmt->execute([$shipperName, $phone]);
}


?>