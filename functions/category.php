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



function create_new_category($categoryname, $description) {
    // Establish a database connection
    $conn = db_conn();

    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare('INSERT INTO categories (CategoryName, Description)
                                VALUES (:CategoryName, :Description)');

        // Bind parameters
        $stmt->bindParam(':CategoryName', $categoryname);
        $stmt->bindParam(':Description', $description);

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