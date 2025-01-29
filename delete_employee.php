<?php
include ('db.php');

if (isset($_GET['id'])) {
    $employee_ID = $_GET['id'];

    try {
        // Start a transaction
        $pdo->beginTransaction();

        // Delete related attendance records
        $sql = "DELETE FROM Attendance_Record WHERE employee_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_ID]);

        // Delete related performance evaluations
        $sql = "DELETE FROM Performance_Evaluation WHERE employee_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_ID]);

        // Now, delete the employee
        $sql = "DELETE FROM Employee WHERE employee_ID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$employee_ID]);

        // Commit the transaction
        $pdo->commit();

        echo "Employee deleted successfully!";
        header("Location: view_employees.php"); // Redirect back to the employee list
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction if something goes wrong
        $pdo->rollBack();
        echo "Error deleting employee: " . htmlspecialchars($e->getMessage());
        exit();
    }
} else {
    echo "No employee ID provided!";
}
?>