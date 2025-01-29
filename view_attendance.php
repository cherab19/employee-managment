<?php
include ('db.php');

// Fetch attendance records
$sql = "SELECT ar.record_ID, e.name, ar.date, ar.clock_in_time, ar.clock_out_time, ar.total_hours 
        FROM Attendance_Record ar 
        JOIN Employee e ON ar.employee_ID = e.employee_ID";
$stmt = $pdo->query($sql);
$attendance_records = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Attendance Records</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #5cb85c;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h2>Attendance Records</h2>
    <table>
        <tr>
            <th>Record ID</th>
            <th>Employee Name</th>
            <th>Date</th>
            <th>Clock In Time</th>
            <th>Clock Out Time</th>
            <th>Total Hours</th>
        </tr>
        <?php foreach ($attendance_records as $record): ?>
        <tr>
            <td><?php echo $record['record_ID']; ?></td>
            <td><?php echo $record['name']; ?></td>
            <td><?php echo $record['date']; ?></td>
            <td><?php echo $record['clock_in_time']; ?></td>
            <td><?php echo $record['clock_out_time']; ?></td>
            <td><?php echo $record['total_hours']; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>