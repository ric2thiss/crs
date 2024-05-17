<?php 

function db_conn(){
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "crs";
    $conn = null;

    try {
        $conn = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully"; 
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }

    return $conn;
}

?>
