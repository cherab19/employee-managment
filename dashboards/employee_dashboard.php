<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Employee') {
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
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        p {
            text-align: center;
            color: #555;
        }

        .dashboard-container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dashboard-image {
            display: block;
            margin: 0 auto 20px;
            max-width: 80%;
            height: auto;
            border-radius: 6px;
        }

        .content {
            margin-top: 20px;
            text-align: center;
        }

        .nav {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-around;
            padding: 10px 0;
            z-index: 1000;
        }

        .nav ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        .nav li {
            flex: 1;
            text-align: center;
        }

        .nav a {
            text-decoration: none;
            color: #007BFF;
            padding: 10px 15px;
            border: 1px solid #007BFF;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            display: block;
            margin: 0 auto;
            max-width: 120px;
        }

        .nav a:hover {
            background-color: #007BFF;
            color: white;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            color: #7f8c8d;
            font-size: 0.9em;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .nav a {
                padding: 12px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .nav {
                flex-direction: column;
                position: static;
            }

            .nav ul {
                flex-direction: column;
                align-items: center;
            }

            .nav a {
                width: 100%;
                max-width: none;
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Dire Dawa University Employee Dashboard</h1>
        <img src="https://th.bing.com/th?id=OIP.aF8uQdapJ194qRU2t1LpTAHaE7&w=306&h=204&c=8&rs=1&qlt=90&o=6&dpr=1.5&pid=3.1&rm=2" alt="Employee Dashboard" class="dashboard-image">
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
    </header>

    <div class="content">
        <?php
        switch ($page) {
            case 'log_attendance':
                include 'log_attendance.php';
                break;
            case 'submit_leave_request':
                include 'submit_leave_request.php';
                break;
            default:
                echo "<p>Welcome to your dashboard. Select an option from the menu.</p>";
        }
        ?>
    </div>

    <nav class="nav">
        <ul>
            <li><a href="log_attendance.php">Log Attendance</a></li>
            <li><a href="submit_leave.php">Submit Leave Request</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

   
</body>
</html>
