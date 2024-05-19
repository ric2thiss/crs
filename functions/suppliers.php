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

function save_new_supplier($data) {
    $conn = db_conn();
    $stmt = $conn->prepare("INSERT INTO suppliers (SupplierName, ContactName, Address, City, PostalCode, Country, Phone) VALUES (?, ?, ?, ?, ?, ?, ?)");

    return $stmt->execute([
        $data['SupplierName'],
        $data['contactname'],
        $data['address'],
        $data['city'],
        $data['postal'],
        $data['country'],
        $data['phone']
    ]);
}
?>


?>