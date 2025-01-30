<?php
// Database connection settings

$servername = "127.0.0.1:3307"; 
$username = "root"; 
$password = ""; // Default password empty
$dbname = "student_management"; // The name of your database

// Create connection to the MySQL database using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); // Show error if connection fails
}
?>
