<?php
include ('db.php');

// Fetch reports
$sql = "SELECT report_ID, report_type, generated_date, data FROM Report";
$stmt = $pdo->query($sql);
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Reports</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        /* Basic modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Generated Reports</h2>
    <table>
        <tr>
            <th>Report ID</th>
            <th>Report Type</th>
            <th>Generated Date</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($reports as $report): ?>
        <tr>
            <td><?php echo $report['report_ID']; ?></td>
            <td><?php echo htmlspecialchars($report['report_type']); ?></td>
            <td><?php echo htmlspecialchars($report['generated_date']); ?></td>
            <td>
                <button onclick="openModal('<?php echo addslashes($report['data']); ?>')">View Data</button>
                <form method="POST" action="export_report.php" style="display:inline;">
                    <input ```php
                    type="hidden" name="report_ID" value="<?php echo $report['report_ID']; ?>">
                    <input type="submit" value="Export">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Modal for viewing report data -->
    <div id="dataModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>Report Data</h2>
            <pre id="reportData"></pre>
        </div>
    </div>

    <script>
        function openModal(data) {
            console.log("Opening modal with data: ", data); // Debugging statement
            document.getElementById("reportData").textContent = data;
            document.getElementById("dataModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("dataModal").style.display = "none";
        }

        // Close the modal when clicking outside of it
        window.onclick = function(event) {
            var modal = document.getElementById("dataModal");
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>