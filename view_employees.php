<?php
include ('db.php');

$sql = "SELECT * FROM Employee";
$stmt = $pdo->query($sql);
$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Employees</title>
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        a {
            text-decoration: none;
            color: #007BFF;
            padding: 5px 10px;
            border: 1px solid #007BFF;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
        }
        a:hover {
            background-color: #007BFF;
            color: white;
        }
        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <h2>Employee List</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Job Title</th>
            <th>Department</th>
            <th>Hire Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee['employee_ID']; ?></td>
            <td><?php echo $employee['name']; ?></td>
            <td><?php echo $employee['address']; ?></td>
            <td><?php echo $employee['phone']; ?></td>
            <td><?php echo $employee['email']; ?></td>
            <td><?php echo $employee['job_title']; ?></td>
            <td><?php echo $employee['department']; ?></td>
            <td><?php echo $employee['hire_date']; ?></td>
            <td><?php echo $employee['employment_status']; ?></td>
            <td class="action-buttons">
                <a href="edit_employee.php?id=<?php echo $employee['employee_ID']; ?>">Edit</a>
                <a href="delete_employee.php?id=<?php echo $employee['employee_ID']; ?>" onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>