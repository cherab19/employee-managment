<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$db = 'diredawa_university';
$user = 'root'; // Default user for XAMPP
$pass = ''; // Default password for XAMPP

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: confirm connection
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>