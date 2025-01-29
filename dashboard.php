<?php
session_start();

if (!isset($_SESSION['role'])) {
    header('Location: login.php');
    exit;
}

$role = $_SESSION['role'];

switch ($role) {
    case 'HR Staff':
        include 'dashboards/hr_dashboard.php';
        break;
    case 'Employee':
        include 'dashboards/employee_dashboard.php';
        break;
    case 'Department Head':
        include 'dashboards/Department head_dashboard.php';
        break;
    case 'Management':
        include 'dashboards/management_dashboard.php';
        break;
    default:
        echo "Unauthorized access!";
        session_destroy();
        exit;
}
?>
