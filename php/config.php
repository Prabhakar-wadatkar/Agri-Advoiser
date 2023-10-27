<?php
// Database configuration
$host = '127.0.0.1';
$dbUsername = 'root';
$dbPassword = '';
$dbName = 'agri_db';

// Establish database connection
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
else 
// echo "connection is ok";

?>
