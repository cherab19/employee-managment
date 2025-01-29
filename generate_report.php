<?php
include ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $report_type = $_POST['report_type'];
    $generated_date = date('Y-m-d');
    $data = ''; // Placeholder for report data

    // Logic to generate report data based on report type
    if ($report_type == 'employee') {
        $sql = "SELECT * FROM Employee";
        $stmt = $pdo->query($sql);
        $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $data = json_encode($employees);
    }

    $sql = "INSERT INTO Report (report_type, generated_date, data) 
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$report_type, $generated_date, $data]);
    echo "<p class='success-message'>Report generated successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Generate Report</title>
    <link rel="stylesheet" href="../styles.css">
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
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        select:focus {
            border-color: #007BFF;
            outline: none;
        }
        input[type="submit"] {
            background-color: #28a745; /* Green color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #218838; /* Darker green on hover */
        }
        .success-message {
            color: green;
            text-align: center;
            margin-top: 20px;
        }
        @media (max-width: 600px) {
            form {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <h2>Generate Report</h2>
    <form method="POST" action="">
        <label>Report Type:</label>
        <select name="report_type" required>
            <option value="employee">Employee Report</option>
            <option value="attendance">Attendance Report</option>
            <option value="leave">Leave Report</option>
            <option value="evaluation">Evaluation Report</option>
        </select>
        <input type="submit" value="Generate Report">
    </form>
</body>
</html>