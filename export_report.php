<?php
// export_report.php

// Database connection parameters
$host = 'localhost'; // Database host
$db = 'diredawa_university'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the report data from the report table
    $stmt = $pdo->prepare("SELECT * FROM report"); // Adjust the query as needed
    $stmt->execute();
    $reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set headers for CSV download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="report.csv"');
    header('Pragma: no-cache');
    header('Expires: 0');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Output column headings
    if (!empty($reports)) {
        fputcsv($output, array_keys($reports[0])); // Output the column names
    }

    // Output data rows
    foreach ($reports as $report) {
        fputcsv($output, $report);
    }

    // Close the output stream
    fclose($output);
    exit;

} catch (PDOException $e) {
    // Handle any errors
    echo "Error: " . $e->getMessage();
}
?>