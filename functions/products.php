<?php

function fetch_products_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from products');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_products(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM products');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function save_product_to_database($productName, $supplierID, $categoryID, $unit, $price) {
    $conn = db_conn();

    try {
        // Prepare SQL statement to insert the product
        $stmt = $conn->prepare('INSERT INTO products (ProductName, SupplierID, CategoryID, Unit, Price) 
                                VALUES (?, ?, ?, ?, ?)');
        
        // Bind parameters and execute the statement
        $stmt->execute([$productName, $supplierID, $categoryID, $unit, $price]);
        
        return true;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

?>