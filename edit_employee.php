<?php
include ('db.php');

// Check if the employee ID is provided
if (isset($_GET['id'])) {
    $employee_ID = $_GET['id'];

    // Fetch the employee details
    $sql = "SELECT * FROM Employee WHERE employee_ID = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$employee_ID]);
    $employee = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if employee exists
    if (!$employee) {
        echo "Employee not found!";
        exit();
    }
}

// Update employee details if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $job_title = $_POST['job_title'];
    $department = $_POST['department'];
    $hire_date = $_POST['hire_date'];
    $employment_status = $_POST['employment_status'];

    $sql = "UPDATE Employee SET name=?, address=?, phone=?, email=?, job_title=?, department=?, hire_date=?, employment_status=? WHERE employee_ID=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $address, $phone, $email, $job_title, $department, $hire_date, $employment_status, $employee_ID]);

    echo "Employee updated successfully!";
    header("Location: view_employees.php"); // Redirect back to the employee list
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Edit Employee</h2>
    <form method="POST" action="">
        <input type="hidden" name="employee_ID" value="<?php echo $employee['employee_ID']; ?>">
        <label>Name:</label><br>
        <input type="text" name="name" value="<?php echo $employee['name']; ?>" required><br>
        <label>Address:</label><br>
        <input type="text" name="address" value="<?php echo $employee['address']; ?>" required><br>
        <label>Phone:</label><br>
        <input type="text" name="phone" value="<?php echo $employee['phone']; ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo $employee['email']; ?>" required><br>
        <label>Job Title:</label><br>
        <input type="text" name="job_title" value="<?php echo $employee['job_title']; ?>" required><br>
        <label>Department:</label><br>
        <input type="text" name="department" value="<?php echo $employee['department']; ?>" required><br>
        <label>Hire Date:</label><br>
        <input type="date" name="hire_date" value="<?php echo $employee['hire_date']; ?>" required><br>
        <label>Employment Status:</label><br>
        <input type="text" name="employment_status" value="<?php echo $employee['employment_status']; ?>" required><br>
        <input type="submit" value="Update Employee">
    </form>
</body>
</html>