<?php
include ('db.php');

// Fetch performance evaluations
$sql = "SELECT pe.evaluation_ID, e.name, pe.evaluation_date, pe.rating, pe.comments 
        FROM Performance_Evaluation pe 
        JOIN Employee e ON pe.employee_ID = e.employee_ID";
$stmt = $pdo->query($sql);
$evaluations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Performance Evaluations</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Performance Evaluations</h2>
    <table>
        <tr>
            <th>Evaluation ID</th>
            <th>Employee Name</th>
            <th>Evaluation Date</th>
            <th>Rating</th>
            <th>Comments</th>
        </tr>
        <?php foreach ($evaluations as $evaluation): ?>
        <tr>
            <td><?php echo $evaluation['evaluation_ID']; ?></td>
            <td><?php echo $evaluation['name']; ?></td>
            <td><?php echo $evaluation['evaluation_date']; ?></td>
            <td><?php echo $evaluation['rating']; ?></td>
            <td><?php echo htmlspecialchars($evaluation['comments']); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>