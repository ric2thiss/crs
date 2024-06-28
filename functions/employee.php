<?php

function fetch_employees_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from employee');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
}

function fetch_employees(){
    $conn = db_conn();
    $stmt = $conn->query('SELECT * FROM employee ORDER BY EMPLOYEEID DESC');

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


function save_employee_to_database($firstname, $lastname, $birthdate, $note, $fileContent) {
    $conn = db_conn();
    try {
        // Prepare SQL statement
        $stmt = $conn->prepare('INSERT INTO employee (LastName, FirstName, BirthDate, Photo, Notes) 
                                VALUES (:LastName, :FirstName, :BirthDate, :Photo, :Notes)');
        
        // Bind parameters
        $stmt->bindParam(':LastName', $lastname);
        $stmt->bindParam(':FirstName', $firstname);
        $stmt->bindParam(':BirthDate', $birthdate);
        $stmt->bindParam(':Photo', $fileContent, PDO::PARAM_LOB);
        $stmt->bindParam(':Notes', $note);
        
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