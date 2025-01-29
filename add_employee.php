<?php
include ('db.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['role'])) {
    header('Location: ../login.php'); // Redirect to login if not logged in
    exit;
}

// Check if the user is HR Staff
if ($_SESSION['role'] !== 'HR Staff') {
    echo "Unauthorized access! You do not have permission to add employees.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $job_title = $_POST['job_title'];
    $department = $_POST['department'];
    $hire_date = $_POST['hire_date'];
    $employment_status = $_POST['employment_status'];

    $sql = "INSERT INTO Employee (name, address, phone, email, job_title, department, hire_date, employment_status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $address, $phone, $email, $job_title, $department, $hire_date, $employment_status]);
    echo "<p style='color: green;'>Employee added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Employee</title>
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
            max-width: 500px;
            margin: 0 auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="date"]:focus {
            border-color: #007BFF;
            outline: none;
        }
        input[type="submit"] {
            background-color: #007BFF;
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
            background-color: #0056b3;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Add Employee</h2>
    <form method="POST" action="">
        <label>Name:</label>
        <input type="text" name="name" required>
        
        <label>Address:</label>
        <input type="text" name="address" required>
        
        <label>Phone:</label>
        <input type="text" name="phone" required>
        
        <label>Email:</label>
        <input type="email" name="email" required>
        
        <label>Job Title:</label>
        <input type="text" name="job_title" required>
        
        <label>Department:</label>
        <input type="text" name="department" required>
        
        <label>Hire Date:</label>
        <input type="date" name="hire_date" required>
        
        <label>Employment Status:</label>
        <input type="text" name="employment_status" required>
        
        <input type="submit" value="Add Employee">
    </form>
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
        <p class ="success-message">Employee added successfully!</p>
    <?php endif; ?>
</body>
</html>