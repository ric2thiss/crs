<?php

    include 'db.php';

    function fetch_customers(){
        $conn = db_conn();

        $stmt = $conn->query('SELECT * FROM Customer');

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetch_customers_count(){
        $conn = db_conn();
    
        $stmt = $conn->query('SELECT COUNT(*) from Customer');
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['COUNT(*)'];
    }

    function create_new_customer($customerName, $contactName, $address, $city, $postalCode, $country){
        $conn = db_conn();
    
            try {
                // Prepare the SQL statement
                $stmt = $conn->prepare('INSERT INTO Customer(CustomerName, ContactName, Address, City, PostalCode, Country)
                                    VALUES(:customerName, :contactName, :address, :city, :postalCode, :country)');
                
                // Bind parameters
                $stmt->bindParam(':customerName', $customerName);
                $stmt->bindParam(':contactName', $contactName);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':city', $city);
                $stmt->bindParam(':postalCode', $postalCode);
                $stmt->bindParam(':country', $country);
    
                // Execute the statement
                $stmt->execute();
    
                // If the execution is successful, return true
                return true;
            } catch (PDOException $e) {
                // If an error occurs, return false or handle the error as needed
                echo "Error: " . $e->getMessage();
                return false;
            }
        }


?>