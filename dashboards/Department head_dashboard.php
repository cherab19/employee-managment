<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Department Head') {
    header('Location: unauthorized.php');
    exit;
}
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Head Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3);
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2.5em;
            margin: 20px 0;
        }
        p {
            text-align: center;
            color: #34495e;
            font-size: 1.2em;
        }
        .nav {
            display: flex;
            justify-content: center;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 10px;
        }
        .nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 15px;
        }
        .nav li {
            display: inline-block;
        }
        .nav a {
            text-decoration: none;
            color: #ffffff;
            background-color: #28a745;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .nav a:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }
        .content {
            max-width: 800px;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .header-image {
            display: block;
            margin: 0 auto 20px;
            max-width: 90%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 0.9em;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2em;
            }
            .nav ul {
                flex-direction: column;
                align-items: center;
            }
            .nav a {
                width: 90%;
                text-align: center;
                padding: 10px;
            }
            .content {
                padding: 15px;
            }
        }
        @media (max-width: 480px) {
            h1 {
                font-size: 1.8em;
            }
            .nav a {
                width: 100%;
                font-size: 1em;
            }
            .header-image {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Dire Dawa University Department Head Dashboard</h1>
    <img src="https://th.bing.com/th?id=OIP.aF8uQdapJ194qRU2t1LpTAHaE7&w=306&h=204&c=8&rs=1&qlt=90&o=6&dpr=1.5&pid=3.1&rm=2" alt="Dashboard Header Image" class="header-image">
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

    <!-- Navigation Links -->
    <div class="nav">
        <ul>
            <li><a href="view_attendance.php">View Attendance</a></li>
            <li><a href="generate_report.php">Generate Report</a></li>
            <li><a href="manage_leaves.php">Manage Leave</a></li>
            <li><a href="conduct_evaluation.php">Conduct Evaluation</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

    <!-- Content Area -->
    <div class="content">
        <?php
        // Dynamically include content based on the page
        switch ($page) {
            case 'view_attendance':
                include 'view_attendance.php';
                break;
            case 'generate_report':
                include 'generate_report.php';
                break;
            case 'manage_leaves':
                include 'manage_leaves.php';
                break;
            case 'conduct_evaluation':
                include 'conduct_evaluation.php';
                break;
            default:
                echo "<p>Welcome to the Department Head Dashboard. Select an action from the menu.</p>";
        }
        ?>
    </div>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Dire Dawa University. All rights reserved.</p>
    </footer>
</body>
</html>
