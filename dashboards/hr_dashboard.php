<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'HR Staff') {
    header('Location: unauthorized.php');
    exit;
}

// Determine which content to display
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HR Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
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
        .nav {
            display: flex;
            justify-content: center; /* Center the navigation */
            margin-bottom: 20px;
        }
        .nav ul {
            list-style-type: none;
            padding: 0;
            display: flex; /* Use flexbox for horizontal alignment */
            justify-content: center; /* Center the list */
            flex-wrap: wrap; /* Allow wrapping for smaller screens */
        }
        .nav li {
            margin: 10px; /* Add margin for spacing */
        }
        .nav a {
            text-decoration: none;
            color: #007BFF;
            padding: 10px 15px;
            border: 1px solid #007BFF;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            display: inline-block; /* Ensure the link behaves like a block */
            min-width: 150px; /* Set a minimum width for buttons */
            text-align: center; /* Center text inside buttons */
        }
        .nav a:hover {
            background-color: #007BFF;
            color: white;
        }
        .content {
            margin-top: 20px;
        }
        .dashboard-image {
            display: block;
            margin: 0 auto 20px;
            max-width: 80%;
            height: auto;
            border-radius: 6px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .dashboard-container {
                padding: 10px;
            }
            .nav ul {
                flex-direction: column; /* Stack navigation items vertically */
            }
            .nav li {
                margin: 5px 0; /* Reduce margin for smaller screens */
            }
            .nav a {
                min-width: 100%; /* Make buttons full width */
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h1> Dire Dawa University HR Staff Dashboard</h1>
        <p>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>

        <!-- Dashboard Image -->
        <img src="https://th.bing.com/th?id=OIP.aF8uQdapJ194qRU2t1LpTAHaE7&w=306&h=204&c=8&rs=1&qlt=90&o=6&dpr=1.5&pid=3.1&rm=2" alt="HR Dashboard" class="dashboard-image">

        <!-- Navigation Links -->
        <div class="nav">
            <ul>
                <li><a href="add_employee.php">Add Employee</a></li>
                <li><a href="view_employees.php">View, Edit and Delete Employee</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>

        <!-- Content Area -->
        <div class="content">
            <?php
            // Dynamically include content based on the page
            switch ($page) {
                case 'add_employee':
                    include 'add_employee.php';
                    break;
                case 'view_employee':
                    include 'view_employees.php'; // Corrected to match the file name
                    break;
                default:
                    echo "<p>Welcome to the HR Dashboard. Select an action from the menu.</p>";
            }
            ?>
        </div>
    </div>
</body>
</html>
