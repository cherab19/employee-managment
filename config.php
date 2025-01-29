<?php
// Database configuration
$host = 'localhost'; // Database host
$dbname = 'diredawa_university'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password (default for XAMPP)

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Optionally, set character set to UTF-8 for proper encoding
$conn->set_charset("utf8");
?>