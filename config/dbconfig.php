<?php

$host = "localhost"; 
$dbname = "accounts"; 
$username = "root"; 
$password = ""; 

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set the PDO to throw exceptions for error handling
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Set default fetch mode to Associative Array
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch(PDOException $e) {
    // If connection fails, show error message
    echo "Connection failed: " . $e->getMessage();
}
?>
