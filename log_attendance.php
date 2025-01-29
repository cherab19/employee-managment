<?php
include ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_ID = $_POST['employee_ID'];
    $date = $_POST['date'];
    $clock_in_time = $_POST['clock_in_time'];
    $clock_out_time = $_POST['clock_out_time'];
    $total_hours = $_POST['total_hours'];

    $sql = "INSERT INTO Attendance_Record (employee_ID, date, clock_in_time, clock_out_time, total_hours) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employee_ID, $date, $clock_in_time, $clock_out_time, $total_hours]);
    echo "Attendance logged successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log Attendance</title>
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

        form {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="number"],
        input[type="date"],
        input[type="time"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h2>Log Attendance</h2>
    <form method="POST" action="">
        <label>Employee ID:</label>
        <input type="number" name="employee_ID" required>
        
        <label>Date:</label>
        <input type="date" name="date" required>
        
        <label>Clock In Time:</label>
        <input type="time" name="clock_in_time" required>
        
        <label>Clock Out Time:</label>
        <input type="time" name="clock_out_time" required>
        
        <label>Total Hours:</label>
        <input type="number" step="0.01" name="total_hours" required>
        
        <input type="submit" value="Log Attendance">
    </form>
</body>
</html>