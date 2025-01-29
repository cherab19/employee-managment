<?php
include ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_ID = $_POST['employee_ID'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $status = 'Pending';

    $sql = "INSERT INTO Leave_Request (employee_ID, leave_type, start_date, end_date, status) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employee_ID, $leave_type, $start_date, $end_date, $status]);
    echo "Leave request submitted successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submit Leave Request</title>
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
        input[type="text"],
        input[type="date"],
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
    <h2>Submit Leave Request</h2>
    <form method="POST" action="">
        <label>Employee ID:</label>
        <input type="number" name="employee_ID" required>
        
        <label>Leave Type:</label>
        <input type="text" name="leave_type" required>
        
        <label>Start Date:</label>
        <input type="date" name="start_date" required>
        
        <label>End Date:</label>
        <input type="date" name="end_date" required>
        
        <input type="submit" value="Submit Leave Request">
    </form>
</body>
</html>