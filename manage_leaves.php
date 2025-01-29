<?php
include ('db.php');

// Fetch leave requests
$sql = "SELECT lr.request_ID, e.name, lr.leave_type, lr.start_date, lr.end_date, lr.status 
        FROM Leave_Request lr 
        JOIN Employee e ON lr.employee_ID = e.employee_ID";
$stmt = $pdo->query($sql);
$leave_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Leave Requests</title>
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

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        @media (max-width: 600px) {
            table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <h2>Manage Leave Requests</h2>
    <table>
        <tr>
            <th>Request ID</th>
            <th>Employee Name</th>
            <th>Leave Type</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($leave_requests as $request): ?>
        <tr>
            <td><?php echo $request['request_ID']; ?></td>
            <td><?php echo $request['name']; ?></td>
            <td><?php echo $request['leave_type']; ?></td>
            <td><?php echo $request['start_date']; ?></td>
            <td><?php echo $request['end_date']; ?></td>
            <td><?php echo $request['status']; ?></td>
            <td>
                <?php if ($request['status'] == 'Pending'): ?>
                    <form method="POST" action="manage_leaves.php" style="display:inline;">
                        <input type="hidden" name="request_ID" value="<?php echo $request['request_ID']; ?>">
                        <input type="submit" name="action" value="Approve">
                    </form>
                    <form method="POST" action="manage_leaves.php" style="display:inline;">
                        <input type="hidden" name="request_ID" value="<?php echo $request['request_ID']; ?>">
                        <input type="submit" name="action" value="Reject">
                    </form>
                <?php else: ?>
                    <span><?php echo $request['status']; ?></span>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <?php
    // Handle approval or rejection of leave requests
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['request_ID']) && isset($_POST['action'])) {
            $request_ID = $_POST['request_ID'];
            $action = $_POST['action'];

            $status = ($action == 'Approve') ? 'Approved' : 'Rejected';
            $sql = "UPDATE Leave_Request SET status=? WHERE request_ID=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$status, $request_ID]);

            echo "<p class='success-message'>Leave request $status successfully!</p>";
            // Refresh the page to see the updated status
            header("Location: manage_leaves.php");
            exit ();
        }
    }
    ?>
</body>
</html>