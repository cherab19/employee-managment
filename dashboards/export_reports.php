<?php
include('db.php');
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $export_type = $_POST['export_type'];
    $filename = "report_" . date('Ymd') . ".csv";

    if ($export_type === 'attendance') {
        $query = "SELECT e.name, a.date, a.time 
                  FROM attendance a
                  JOIN employees e ON a.employee_id = e.id";
    } elseif ($export_type === 'performance') {
        $query = "SELECT e.name, pe.date, pe.evaluation, pe.comments 
                  FROM performance_evaluations pe
                  JOIN employees e ON pe.employee_id = e.id";
    }

    $result = $conn->query($query);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $filename);

    $output = fopen('php://output', 'w');

    if ($export_type === 'attendance') {
        fputcsv($output, ['Employee Name', 'Date', 'Time']);
    } elseif ($export_type === 'performance') {
        fputcsv($output, ['Employee Name', 'Date', 'Evaluation', 'Comments']);
    }

    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }

    fclose($output);
    exit;
}
?>

<h2>Export Reports</h2>
<form method="POST" action="">
    <label for="export_type">Report Type:</label>
    <select name="export_type" required>
        <option value="attendance">Attendance</option>
        <option value="performance">Performance</option>
    </select><br>
    <button type="submit">Export</button>
</form>